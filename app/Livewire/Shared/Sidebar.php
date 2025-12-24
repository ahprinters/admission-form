<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public function logout()
    {
        // লগআউট লজিক এখানে যোগ করুন (যদি প্রয়োজন হয়)
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.shared.sidebar');
    }
}
