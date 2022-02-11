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
    public $political_level = 'barangay';
    public $player;

    protected $listeners = [
        'politicalLevelUpdated' => 'updatePoliticalLevel',
        'provinceUpdated' => 'updateProvince',
        'regionUpdated' => 'updateRegion',
        'municipalityUpdated' => 'updateMunicipality'    
    ];

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
        }elseif($this->player && $this->player->municipality){
            $municipality = $this->player->municipality;
            $this->municipality = $municipality->id;
            $this->province = $municipality->province->id;
            $this->region = $municipality->province->region->id;
            $this->barangay_id = -1;
        }
    }

    public function updatePoliticalLevel($political_level){
        $this->political_level = $political_level;
    }

    /**
     * The following functions are used to push state changes from this 
     * component to its parent component. Parent components who wants
     * to listen should add the following events to their listeners
     */
    public function updatedRegion(){
        $this->emit('regionUpdated', $this->region);
    }

    public function updatedProvince(){
        $this->emit('provinceUpdated', $this->province);
    }

    public function updatedMunicipality(){
        $this->emit('municipalityUpdated', $this->municipality);
    }

    public function updateRegion($region){
        $this->region = $region;
    }

    public function updateProvince($province){
        $this->province = $province;
    }

    public function updateMunicipality($municipality){
        $this->municipality = $municipality;
    }
}
