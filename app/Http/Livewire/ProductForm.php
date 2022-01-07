<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public $player;
    public $common_name;

    protected $rules = [
        'common_name' => 'required|string|max:100',
    ];

    public function render()
    {
        return view('livewire.product-form');
    }

    public function resetFields(){
        $this->common_name = '';
    }

    public function save(){
        $this->validate();
        $product = new Product;
        $product->player_id = $this->player->id;
        $product->common_name = $this->common_name;
        $product->save();

        session()->flash('message', 'Product successfully updated.');
        $this->resetFields();
        $this->emit('product_added');
        $this->emitTo('show-players-product', '$refresh');
    }
}
