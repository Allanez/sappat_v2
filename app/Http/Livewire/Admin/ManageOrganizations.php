<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Organization;
use App\Models\Region;
use App\Models\Province;
use App\Models\Municipality;


class ManageOrganizations extends Component
{
    public $addingNewOrg = false;
    public $confirmingOrgDeletion = false;
    public $updatingOrg = false;
    public $political_level = 'national';
    public $name;
    public $email;
    public $org_id;
    
    /**Copy of properties from Address-Input component */
    public $region;
    public $province;
    public $municipality;

    protected $listeners = [
        'provinceUpdated' => 'updateProvince',
        'regionUpdated' => 'updateRegion',
        'municipalityUpdated' => 'updateMunicipality'
    ];

    protected $rules = [
        'name' => 'required|string|max:200',
        'political_level' => 'required',
        'email' => 'email',
    ];

    public function render()
    {
       $orgs = Organization::all();
        return view('livewire.admin.manage-organizations', ["organizations"=>$orgs]);
    }

    public function store(){
        $this->validate();
        $org = new Organization;
        $org->name = $this->name;
        $org->email = $this->email;
        $org->political_level = $this->political_level;

        if($this->political_level == "regional"){
            $jurisdiction = Region::find($this->region);
            $jurisdiction->organizations()->save($org);
        }else if($this->political_level == "provincial"){
            $jurisdiction = Province::find($this->province);
            $jurisdiction->organizations()->save($org);
        }else if($this->political_level == "municipal"){
            $jurisdiction = Municipality::find($this->municipality);
            $jurisdiction->organizations()->save($org);
        }else{
           $org->save();
        }
       
        $this->addingNewOrg = false;
    }

    public function showingUpdateOrgModal($org_id){
        if($org_id){
            $org = Organization::find($org_id);
            $this->org_id = $org_id;
            $this->name = $org->name;
            $this->email = $org->email;
            $this->political_level = $org->political_level;
            $this->updatingOrg = true;

            if($this->political_level == "municipal"){
                $this->municipality = $org->geographic->id;
                $this->province = $org->geographic->province_id;
                $this->region = $org->geographic->province->region_id;
                $this->emit('municipalityUpdated', $this->municipality);
                $this->emit('provinceUpdated', $this->province);
                $this->emit('regionUpdated', $this->region);
            }else if($this->political_level == "provincial"){
                $this->province = $org->geographic->id;
                $this->region = $org->geographic->region_id;
                $this->emit('provinceUpdated', $this->province);
                $this->emit('regionUpdated', $this->region);
            }else if($this->political_level == "regional"){
                $this->region = $org->geographic->id;
                $this->emit('regionUpdated', $this->region);
            }
            $this->emit('politicalLevelUpdated', $this->political_level);
            
        }else{
            session()->flash('message', 'Organization cannot be found in the database.');
        }
    }

    public function showingNewOrgModal(){
        $this->addingNewOrg = true;
        $this->reset('political_level');
        $this->reset('name');
        $this->reset('email');
        $this->resetErrorBag();
        $this->emit('politicalLevelUpdated', $this->political_level);
    }

    public function showingDeleteOrgModal($org_id){
        $this->confirmingOrgDeletion = true;
        $this->org_id = $org_id;
    }

    public function delete(){
        if($this->org_id){
            Organization::find($this->org_id)->delete();
            session()->flash('message', 'Organization deleted successfully');
        }
        $this->confirmingOrgDeletion = false;
        $this->reset('org_id');
    }

    public function update(){
        $this->validate();
        $org = Organization::find($this->org_id);
        $org->name = $this->name;
        $org->email = $this->email;
        $org->political_level = $this->political_level;

        if($this->political_level == "regional"){
            $jurisdiction = Region::find($this->region);
            $jurisdiction->organizations()->save($org);
        }else if($this->political_level == "provincial"){
            $jurisdiction = Province::find($this->province);
            $jurisdiction->organizations()->save($org);
        }else if($this->political_level == "municipal"){
            $jurisdiction = Municipality::find($this->municipality);
            $jurisdiction->organizations()->save($org);
        }else{
           $org->save();
        }

        $this->updatingOrg = false;
    }
    public function updatedPoliticalLevel(){
        $this->emit('politicalLevelUpdated', $this->political_level);
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
