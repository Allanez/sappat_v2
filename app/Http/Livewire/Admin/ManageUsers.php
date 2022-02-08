<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class ManageUsers extends Component
{
    public $confirmingUserDeletion = false;
    public $user_id;

    public function render()
    {
        $users = User::all();
        return view('livewire.admin.manage-users', ['users' => $users]);
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

}
