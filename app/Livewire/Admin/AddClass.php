<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Teacher;
use App\Models\StudentClass;

class AddClass extends Component
{
    public $grade;
    public $class_name;
    public $class_code;
    public $stream;
    public $teacher;
    public $year;

    public $grades;
    public $streams;
    public $teachers;

    public function mount()
    {
        $this->grades = Grade::all();
        $this->streams = Stream::all();
        $this->teachers = Teacher::all();
    }

    protected $rules = [
        'grade'      => 'required|exists:grades,id',
        'class_name' => 'required|string|max:255',
        'class_code' => 'required|string|max:50|unique:student_classes,class_code',
        'stream'     => 'required|exists:streams,id',
        'teacher'    => 'required|exists:teachers,id',
        'year'       => 'required|integer',
    ];

    public function submit()
    {
        $this->validate();

        StudentClass::create([
            'grade_id' => $this->grade,
            'class_name' => $this->class_name,
            'class_code' => $this->class_code,
            'stream_id' => $this->stream,
            'teacher_id' => $this->teacher,
            'year' => $this->year,
        ]);

        $this->reset(['grade','class_name','class_code','stream','teacher','year']);

        $this->dispatch('swal', [
            'icon' => 'success',
            'message' => 'Class added successfully!'
        ]);
        return redirect()->route('admin.classes.index');
    }

    public function render()
    {
        return view('livewire.admin.add-class');
    }
}
