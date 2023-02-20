<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{

    public User $user;

    public function render()
    {
        return view('livewire.users.users');
    }

    public function mount()
    {

        $this->user = new User;
    }
}
