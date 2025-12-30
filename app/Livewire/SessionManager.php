<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\AcademicSession;

#[Layout('components.layouts.app')]
class SessionManager extends Component
{
    public $name = '';
    public $is_active = true;

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:academic_sessions,name',
            'is_active' => 'boolean',
        ]);

        AcademicSession::create($validated);

        session()->flash('message', 'Academic session added successfully!');

        $this->reset(['name', 'is_active']);
        $this->is_active = true;
    }

    public function delete($id)
    {
        AcademicSession::whereKey($id)->delete();
        session()->flash('message', 'Academic session deleted.');
    }

    public function render()
    {
        return view('livewire.session-manager', [
            'sessions' => AcademicSession::orderByDesc('id')->get(),
        ]);
    }
}
