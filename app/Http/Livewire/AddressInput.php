<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Region;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;

class AddressInput extends Component
{
    public $region;
    public $province;
    public $municipality;
    public $barangay_id;

    public $player;

    public function render()
    {
        
        $regions = Region::all();

        $provinces = array();
        if($this->region){
            $provinces = Province::where('region_id', $this->region)->get();
        }

        $municipalities = array();

        if($this->province){
            $municipalities = Municipality::where('province_id', $this->province)->get();
        }

        $barangays = array();
        if($this->municipality){
            $barangays = Barangay::where('municipality_id', $this->municipality)->get();
        }


        return view('livewire.address-input', 
            ['regions' => $regions, 'provinces' => $provinces, 
            'municipalities' => $municipalities, 'barangays' => $barangays]);
    }

    public function mount(){
        if($this->player && $this->player->barangay){
            $barangay = $this->player->barangay;
            $this->barangay_id = $barangay->id;
            $this->municipality = $barangay->municipality->id;
            $this->province = $barangay->municipality->province->id;
            $this->region = $barangay->municipality->province->region->id;
        }
    }
}
