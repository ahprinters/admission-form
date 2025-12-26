<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentClass;

class ClassesIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.classes-index', [
            'classes' => StudentClass::with(['grade', 'stream', 'teacher'])->get()
        ]);
    }
}
