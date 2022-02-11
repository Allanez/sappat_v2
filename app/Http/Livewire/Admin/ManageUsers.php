<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;

class ManageUsers extends Component
{
    public $confirmingUserDeletion = false;
    public $assigningUserPermission = false;
    public $user_id;

    public $role="viewer";
    public $organization=1;

    public function render()
    {
        $users = User::all();
        $orgs = Organization::orderBy('name')->get();

        return view('livewire.admin.manage-users', 
            [
                'users' => $users,
                'organizations' => $orgs
            ]);
    }

    public function delete(){
        if($this->user_id){
            User::find($this->user_id)->delete();
            session()->flash('message', 'User deleted successfully');
        }
        $this->confirmingUserDeletion = false;
        unset($this->user_id);
    }

    public function showDeleteUserModal($user_id){
        $this->confirmingUserDeletion = true;
        $this->user_id = $user_id;
    }

    public function showAssignPermissionModal($user_id){
        $this->assigningUserPermission = true;
        $this->user_id = $user_id;
        $user = User::find($this->user_id);
        if($user->organization){
            $this->role = $user->role;
            $this->organization = $user->organization_id;
        }
    }

    public function save_permission(){
        if($this->user_id){
            $user = User::find($this->user_id);
            $user->organization_id = $this->organization;
            $user->role = $this->role;
            $user->save();
        }
        $this->assigningUserPermission = false;
    }

}
