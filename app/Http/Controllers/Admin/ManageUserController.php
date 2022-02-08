<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class ManageUserController extends Controller
{
    // list of registered users
    public function index(){
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }
}
