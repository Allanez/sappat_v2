<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;
use App\Models\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class SearchPlayers extends Component
{
    public $search_key = '';
    public $search_field = 'player_name';
    public $product_filter = [];

    public function render()
    {
        $players = Player::all();

        $this->product_filter = array_diff($this->product_filter, [false]);

        $product_names = Product::all_products();


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
        return view('livewire.search-players', ['players' => $players->get(), 'product_names' => $product_names]);
    }

    public function reset_filter(){
        $this->product_filter = [];
    }
}
