<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Semester;
use App\Models\AcademicSession;

#[Layout('components.layouts.app')]
class SemesterManager extends Component
{
    public $semester_name = '';
    public $start_date = null;
    public $end_date = null;
    public $session_id = '';

    public function save()
    {
        $validated = $this->validate([
            'semester_name' => 'required|string|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'session_id'    => 'required|integer|exists:academic_sessions,id',
        ]);

        Semester::create($validated);

        session()->flash('message', 'Semester added successfully!');

        $this->reset(['semester_name', 'start_date', 'end_date', 'session_id']);
    }

    public function delete($id)
    {
        Semester::whereKey($id)->delete();
        session()->flash('message', 'Semester deleted.');
    }

    public function render()
    {
        return view('livewire.semester-manager', [
            'semesters' => Semester::latest()->get(),

            // dropdown এ শুধু নাম দেখানোর জন্য id=>label array
            'academicSessions' => AcademicSession::orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),
        ]);
    }
}
