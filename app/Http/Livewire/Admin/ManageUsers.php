<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class ManageUsers extends Component
{
    public $confirmingUserDeletion = false;

    public function render()
    {
        $users = User::all();
        return view('livewire.admin.manage-users', ['users' => $users]);
    }

    public function delete($id){
        if($id){
            User::find($id)->delete();
            session()->flash('message', 'User deleted successfully');
        }
        $this->confirmingUserDeletion = false;
    }

    public function showDeleteUserModal(){
        $this->confirmingUserDeletion = true;
    }

}
