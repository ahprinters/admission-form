<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentForm extends Component
{
    public $studentId; //for edit functionality in future
    // প্রোপার্টিজ
    public $name_en, $name_bn, $email, $class, $roll_number, $gender;
    public $phone, $date_of_birth, $nid_birth_certificate, $blood_group;
    public $nationality = 'Bangladeshi', $religion, $address, $is_active = true;

    // // রিয়েল-টাইম ভ্যালিডেশনের জন্য (ঐচ্ছিক)
    public function updated($propertyName)
{
    $this->validateOnly($propertyName, [
        'name_en' => 'required',
        'email'   => 'required|email|unique:students,email,' . ($this->studentId ?? 'NULL') . ',id',
        'phone'   => 'required|numeric',
    ]);
}
    public function mount($id = null)
    {
        // যদি $studentId সেট করা থাকে, তাহলে এডিট মোডে কাজ করবে (ভবিষ্যতের জন্য)
        if ($id) {
            $student = Student::findOrFail($id);
                $this->studentId = $student->id;
                $this->name_en = $student->name_en;
                $this->name_bn = $student->name_bn;
                $this->email = $student->email;
                $this->class = $student->class;
                $this->roll_number = $student->roll_number;
                $this->gender = $student->gender;
                $this->phone = $student->phone;
                $this->date_of_birth = $student->date_of_birth;
                $this->nid_birth_certificate = $student->nid_birth_certificate;
                $this->blood_group = $student->blood_group;
                $this->nationality = $student->nationality;
                $this->religion = $student->religion;
                $this->address = $student->address;
                $this->is_active = $student->is_active;
           }
        }

    public function submit()
    {
        $rules = [
            'name_en'               => 'required',
            'name_bn'               => 'required',
            'email'                 => 'required|email|unique:students,email,' . ($this->studentId ?? 'NULL') . ',id',
            'class'                 => 'required',
            'roll_number'           => 'required',
            'gender'                => 'required|in:male,female',
            'phone'                 => 'required|string|max:15',
            'date_of_birth'         => 'nullable|date',
            'nid_birth_certificate' => 'nullable|string',
            'blood_group'           => 'required',
            'religion'              => 'required',
            'nationality'           => 'nullable|string',
            'address'               => 'nullable|string',
            'is_active'             => 'boolean',
        ];
        $validatedData = $this->validate($rules);

        if($this->studentId){
            // আপডেট লজিক (ভবিষ্যতের জন্য)
            $student = Student::findOrFail($this->studentId)->update($validatedData );

            session()->flash('message', 'শিক্ষার্থীর তথ্য সফলভাবে আপডেট করা হয়েছে!');
            return redirect()->route('student.index');
        } else{
            // নতুন ডাটা ইনসার্ট লজিক
            Student::create($validatedData);
            session()->flash('message', 'নতুন শিক্ষার্থীর তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!');
        }
         // ফর্ম রিসেট
        $this->reset();
        // Redirect to student list
        return redirect()->route('student.index');
    }

    public function render()
    {
        return view('livewire.student-form');
    }
}
