<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;

    #[Rule('required|string|min:2|max:255')]
    public $name = '';
    #[Rule('required|email|max:255|unique:users,email')]
    public $email = '';
    #[Rule('required|string|min:8')]
    public $password = '';

    public function createNewUser() {

        $validated =  $this->validate();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $this->reset(['name', 'email', 'password']);

       session()->flash('success', 'Usuario cadastrado com successo');
    }

    public function render()
    {
        $users = User::paginate(5);

        return view('livewire.clicker',[
            'users' => $users
        ]);
    }
}
