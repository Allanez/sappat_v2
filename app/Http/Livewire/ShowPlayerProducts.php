<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShowPlayerProducts extends Component
{
    public $products;
    public $player;
    public $common_name;
    public $product_id;

    protected $rules = [
        'common_name' => 'required|string|max:100',
    ];

    protected $listeners = ['product_added' => '$refresh'];

    public function render()
    {
        $this->products = $this->player->products()->get();
        return view('livewire.show-player-products');
    }

    public function mount(){
        $this->products = $this->player->products()->get();
    }

    public function delete($id){
        if($id){
            Product::find($id)->delete();
            session()->flash('message', 'Product successfully.');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->product_id = $product->id;
        $this->common_name = $product->common_name;
    }

    public function update()
    {
        $this->validate();
        if($this->product_id)
        {
            $product = Product::find($this->product_id);
            $product->update([
                'common_name' => $this->common_name,
            ]);
        }
        $this->emit('product_updated');
        session()->flash('message', 'Product updated successfully.');
    }
}
