<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class ShowPlayerEquipments extends Component
{
    public $player;
    public $common_name;
    public $quantity;
    public $year_acquired;
    public $provider;
    public $status;
    public $remarks;
    public $equipment_id;

    protected $listeners = ['equipment_added' => '$refresh'];
    
    protected $rules = [
        'common_name' => 'required|string|max:200',
        'quantity' => 'required|int|min:1',
    ];

    public function render()
    {
        $equipments = $this->player->equipments()->get();
        return view('livewire.show-player-equipments', ['equipments' => $equipments]);
    }

    public function resetFields(){
        $this->common_name = '';
        $this->quantity='';
        $this->year_acquired='';
        $this->provider='';
        $this->status='';
        $this->remarks='';
    }
    
    public function delete($id){
        if($id){
            Equipment::find($id)->delete();
            session()->flash('message', 'Product successfully.');
        }
    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);
        $this->equipment_id = $equipment->id;
        $this->player->id = $equipment->player_id;
        $this->common_name =  $equipment->common_name;
        $this->quantity = $equipment->quantity;
        $this->year_acquired = $equipment->year_acquired;
        $this->provider = $equipment->provider;
        $this->status = $equipment->status;
        $this->remarks = $equipment->remarks;
    }

    public function update()
    {
        $this->validate();
        if($this->equipment_id)
        {
            $product = Equipment::find($this->equipment_id);
            $product->update([
                'common_name' => $this->common_name,
                'quantity' => $this->quantity,
                'year_acquired' => $this->year_acquired,
                'provider' => $this->provider,
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
        }
        $this->emit('equipment_updated');
        session()->flash('message', 'Equipment updated successfully.');
    }
}
