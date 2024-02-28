<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RegisterForm extends Component
{
    use WithPagination, WithFileUploads;

    #[Rule('required|string|min:2|max:255')]
    public $name = '';
    #[Rule('required|email|max:255|unique:users,email')]
    public $email = '';
    #[Rule('required|string|min:8')]
    public $password = '';
    #[Rule('required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|sometimes')]
    public $image;
    

    public function createNewUser() {

        $validated =  $this->validate();

        if($this->image)
        {
           $validated['image'] = $this->image->store('uploads','public');
        }

        User::create($validated);

        $this->reset(['name', 'email', 'password','image']);

       session()->flash('success', 'Usuario cadastrado com successo');
    }

    public function render()
    {
        $users = User::paginate(5);

        return view('livewire.register-form',[
            'users' => $users
        ]);
    }
}
