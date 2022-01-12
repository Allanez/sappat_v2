<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class EquipmentForm extends Component
{
    public $player;
    public $common_name;
    public $quantity;
    public $date_acquired;
    public $provider;
    public $status;
    public $remarks;

    protected $rules = [
        'common_name' => 'required|string|max:200',
        'quantity' => 'required|int|min:1',
    ];

    public function render()
    {
       
        return view('livewire.equipment-form');
    }

    public function resetFields(){
        $this->common_name = '';
        $this->quantity='';
        $this->date_acquired='';
        $this->provider='';
        $this->status='';
        $this->remarks='';
    }

    public function save(){
        $this->validate();
        $equipment = new Equipment;
        $equipment->player_id = $this->player->id;
        $equipment->common_name = $this->common_name;
        $equipment->quantity = $this->quantity;
        $equipment->date_acquired = $this->date_acquired;
        $equipment->provider = $this->provider;
        $equipment->status = $this->status;
        $equipment->remarks = $this->remarks;
        $equipment->save();

        session()->flash('message', 'Equipment successfully updated.');
        $this->resetFields();
        $this->emit('equipment_added');
        $this->emitTo('show-players-equipment', '$refresh');
    }

    public function mount(){
        $this->status = 'not indicated';
        $this->date_acquired = date('Y-m-d');
    }
}
