<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Teacher;
use App\Models\StudentClass;
use App\Models\AcademicYear;

class AddClass extends Component
{
    // Form fields (FK aligned)
    public $grade_id;
    public $class_name;
    public $class_code;
    public $stream_id;
    public $teacher_id;
    public $academic_year_id;

    // Dropdown data
    public $grades;
    public $streams;
    public $teachers;
    public $academicYears;

    public function mount()
    {
        $this->grades        = Grade::orderBy('id')->get();
        $this->streams       = Stream::orderBy('id')->get();
        $this->teachers      = Teacher::orderBy('id')->get();
        $this->academicYears = AcademicYear::where('is_active', true)
                                ->orderBy('start_year', 'desc')
                                ->get();
    }

    protected $rules = [
        'grade_id'          => 'required|exists:grades,id',
        'class_name'        => 'required|string|max:255',
        'class_code'        => 'required|string|max:50|unique:student_classes,class_code',
        'stream_id'         => 'nullable|exists:streams,id',
        'teacher_id'        => 'nullable|exists:teachers,id',
        'academic_year_id'  => 'required|exists:academic_years,id',
    ];

    public function submit()
    {
        $this->validate();

        StudentClass::create([
            'grade_id'         => $this->grade_id,
            'class_name'       => $this->class_name,
            'class_code'       => $this->class_code,
            'stream_id'        => $this->stream_id,
            'teacher_id'       => $this->teacher_id,
            'academic_year_id' => $this->academic_year_id,
        ]);

        $this->reset([
            'grade_id',
            'class_name',
            'class_code',
            'stream_id',
            'teacher_id',
            'academic_year_id'
        ]);

        $this->dispatch('swal', [
            'icon'    => 'success',
            'message' => 'Class added successfully!'
        ]);

        return redirect()->route('admin.classes.index');
    }

    public function render()
    {
        return view('livewire.admin.add-class');
    }
}
