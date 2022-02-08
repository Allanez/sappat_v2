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

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $players = Player::all();

        $this->product_filter = array_diff($this->product_filter, [false]);
        $this->location_filter = array_diff($this->location_filter, [false]);

        $product_names = Product::all_products();
        $locations = Municipality::with_players();

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
                $query->whereIn('common_name', $this->product_filter);
            });
        }

        if($this->location_filter){
            $locs = $this->location_filter;
            foreach($locs as $key => $element){
                $players= $players->Where('address', 'like', "%$element%");
            }
        }

        return view('livewire.search-players', ['players' => $players->paginate(2), 
                'product_names' => $product_names,
                'locations' => $locations]);
    }

    public function reset_filter(){
        $this->product_filter = [];
        $this->location_filter = [];
    }
}
