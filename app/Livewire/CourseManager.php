<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AcademicSession;
use App\Models\StudentClass;

#[Layout('components.layouts.app')]
class CourseManager extends Component
{
    public $course_name = '';
    public $course_type = '';
    public $class_id = '';
    public $semester_id = '';
    public $session_id = '';

    public function save()
    {
        $validated = $this->validate([
            'course_name'  => 'required|string|max:255',
            'course_type'  => 'required|string|max:255',
            'class_id'     => 'required|integer|exists:student_classes,id',
            'semester_id'  => 'required|integer|exists:semesters,id',
            'session_id'   => 'required|integer|exists:academic_sessions,id',

            // একই ক্লাস+সেমিস্টার+সেশনে একই নাম ডুপ্লিকেট না হতে চাইলে:
            // 'course_name' => 'required|string|max:255|unique:courses,course_name,NULL,id,class_id,' . $this->class_id . ',semester_id,' . $this->semester_id . ',session_id,' . $this->session_id,
        ]);

        Course::create($validated);

        session()->flash('message', 'Course added successfully!');

        $this->reset(['course_name', 'course_type', 'class_id', 'semester_id', 'session_id']);
    }

    public function delete($id)
    {
        Course::whereKey($id)->delete();
        session()->flash('message', 'Course deleted.');
    }

    public function render()
    {
        return view('livewire.course-manager', [
            'courses' => Course::latest()->get(),

            // id => label array
            'classes' => StudentClass::orderBy('class_name')
                ->pluck('class_name', 'id')
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
