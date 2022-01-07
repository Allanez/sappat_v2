<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Player;

use Illuminate\Database\Eloquent\Builder;

class SearchPlayers extends Component
{
    public $search_key = '';
    public $search_field = 'player_name';

    public function render()
    {
        $players = Player::all();

        if($this->search_field == 'product_name')
        {
            $players = Player::whereHas('products', function (Builder $query){
                $query->where('common_name', 'like', "%$this->search_key%");
            })->get();
        }

        if($this->search_field == 'player_name')
        {
            $players = Player::where('name', 'like', "%$this->search_key%")->get();
        }
        
        if($this->search_field == 'address')
        {
            $players = Player::where('address', 'like', "%$this->search_key%")->get();
        }

        return view('livewire.search-players', ['players' => $players]);
    }
}
