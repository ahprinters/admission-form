<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class StudentList extends Component
{
    use WithPagination; // পেজিনেশনের জন্য

    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'শিক্ষার্থীর তথ্য মুছে ফেলা হয়েছে।');
    }

    public function render()
    {
        return view('livewire.student-list', [
            'students' => Student::latest()->paginate(5)
        ])->layout('components.layouts.admin');
    }
}

