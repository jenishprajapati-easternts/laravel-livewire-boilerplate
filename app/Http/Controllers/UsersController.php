<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function create()
    {

        return view('create-user');
    }


    public function viewUsers()
    {

        return view('livewire.users-list');
    }
}
