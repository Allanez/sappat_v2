<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Product;
use App\Models\Municipality;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class SearchPlayers extends Component
{
    public $search_key = '';
    public $search_field = 'player_name';
    public $product_filter = [];
    public $location_filter = [];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $players = Player::all();

        $this->product_filter = array_diff($this->product_filter, [false]);
        $this->location_filter = array_diff($this->location_filter, [false]);

        #apply main search
        if($this->search_field == 'product_name')
        {
            $players = Player::whereHas('products', function (Builder $query){
                $query->where('common_name', 'like', "%$this->search_key%");
            });
        }

        if($this->search_field == 'player_name')
        {
            $players = Player::where('name', 'like', "%$this->search_key%");
        }
        
        if($this->search_field == 'address')
        {
            $players = Player::where('address', 'like', "%$this->search_key%");
        }

        if($this->product_filter){
            $players = $players->whereHas('products', function (Builder $query){
                $query->WhereIn('common_name', $this->product_filter);
            });
        }

        if($this->location_filter){
            $locs = $this->location_filter;
            foreach($locs as $key => $element){
                $players= $players->Where('address', 'like', "%$element%");
            }
        }

        /*$product_names = Product::
        ->groupBy('common_name')
        ->select('common_name', DB::raw('count(*) as hits'))
        ->orderByRaw('common_name, hits')
        ->limit(10)
        ->get();
        */
        $player_ids = $players->pluck('id');
        
        $products = Product::whereIn('player_id', $player_ids)
        ->groupBy('common_name')
        ->select('common_name', DB::raw('count(*) as hits'))
        ->orderByRaw('common_name, hits')
        ->limit(10)
        ->get();

        if($this->product_filter){
            $product_name = end($this->product_filter);
            $products = Product::whereIn('player_id', $player_ids)
                ->where('common_name', '=', $product_name)
                ->groupBy('common_name')
                ->select('common_name', DB::raw('count(*) as hits'))
                ->get();
        }
        
        $locations = Municipality::with_players($player_ids);

        return view('livewire.search-players', ['players' => $players->paginate(10), 
                'products' => $products,
                'locations' => $locations]);
    }

    public function updatedProductFilter(){
        $this->resetPage();
    }

    public function updatedSearchKey(){
        $this->resetPage();
    }

    public function updatedLocationFilter(){
        $this->resetPage();
    }

    public function reset_filter(){
        $this->product_filter = [];
        $this->location_filter = [];
    }
}
