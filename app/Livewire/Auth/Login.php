<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Validation\ValidationException;


class Login extends Component
{
    #[Rule('required|email', message: 'একটি সঠিক ইমেইল ঠিকানা দিন')]
    public $email;

    #[Rule('required', message: 'পাসওয়ার্ড দিন')]
    public $password;

    public $remember = false;

    public function login()
    {
        $this->validate();

        // ইমেইল এবং পাসওয়ার্ড দিয়ে লগইন করার চেষ্টা
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // লগইন সফল হলে ড্যাশবোর্ডে রিডাইরেক্ট
            return redirect()->intended('/dashboard');
        }

        // লগইন ব্যর্থ হলে এরর মেসেজ
        throw ValidationException::withMessages([
            'email' => 'প্রদত্ত ইমেইল বা পাসওয়ার্ড আমাদের রেকর্ডের সাথে মিলছে না।',
        ]);
    }

    // logout logic can be added here in future
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.app');
    }
}
