<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AcademicSession;

#[Layout('components.layouts.app')]
class ExamManager extends Component
{
    public $exam_name = '';
    public $start_date = null;
    public $end_date = null;
    public $semester_id = '';
    public $course_id = '';
    public $session_id = '';

    public function saveExam()
    {
        $validated = $this->validate([
            'exam_name'   => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'semester_id' => 'required|integer|exists:semesters,id',
            'course_id'   => 'required|integer|exists:courses,id',
            'session_id'  => 'required|integer|exists:academic_sessions,id',
        ]);

        Exam::create($validated);

        session()->flash('message', 'Exam created successfully!');

        // ফর্ম ফিল্ডগুলো রিসেট (dropdowns সহ)
        $this->reset([
            'exam_name',
            'start_date',
            'end_date',
            'semester_id',
            'course_id',
            'session_id',
        ]);
    }

    public function render()
    {
        return view('livewire.exam-manager', [
            'exams' => Exam::latest()->get(),

            'courses' => Course::orderBy('course_name')
                ->pluck('course_name', 'id')
                ->toArray(),

            'semesters' => Semester::orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            'academicSessions' => AcademicSession::orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),
        ]);
    }

}
