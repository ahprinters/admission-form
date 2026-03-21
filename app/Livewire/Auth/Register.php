<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    // public $role;  // New field for role

    // Validation rules
    public function register()
    {
        // Validate user input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // 'role' => 'required|in:user,admin', // Validate role input
        ]);

        // Create the new user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),  // Hash the password
            // 'role' => $this->role,  // Save the selected role
        ]);

        // Flash success message
        session()->flash('success', 'Registration successful! Please login.');

        // Redirect to login page
        return $this->redirect(Login::class);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
