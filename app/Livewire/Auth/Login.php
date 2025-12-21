<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Login extends Component
{
    #[Rule('required', message:'Enter your username')]
    public $username;
    #[Rule('required', message:'Enter your password')]
    public $password;

    #[Rule('required |same:password', message:'Password confirmation is required')]
    public $password_confirmation;

    public $remember = false;

    public function login()
    {
        $this->validate();

        // Authentication logic here
        if(Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            // Redirect or perform actions on successful login
            return redirect()->intended('/dashboard');
        }
        session()->flash('error', 'The provided credentials do not match our records.');

    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
