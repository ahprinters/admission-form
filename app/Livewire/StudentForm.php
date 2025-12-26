<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\StudentClass;

class StudentForm extends Component
{
    public $studentId;

    // প্রোপার্টিজ
    public $name_en, $name_bn, $email, $class, $roll_number, $gender;
    public $phone, $date_of_birth, $nid_birth_certificate, $blood_group;
    public $nationality = 'Bangladeshi', $religion, $address, $is_active = true;

    // ভ্যালিডেশন রুলস (এক জায়গায় রাখা ভালো)
    protected function rules()
    {
        return [
            'name_en'               => 'required|min:3',
            'name_bn'               => 'required|min:3',
            'email'                 => 'required|email|unique:students,email,' . ($this->studentId ?? 'NULL'),
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
    }

    // রিয়েল-টাইম ভ্যালিডেশন
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($id = null)
    {
        if ($id) {
            $student = Student::findOrFail($id);
            $this->studentId = $student->id;
            $this->fill($student->toArray()); // fill() ব্যবহার করলে কোড অনেক ছোট হয়
        }
    }

    public function submit()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->studentId) {
                // আপডেট লজিক
                Student::find($this->studentId)->update($validatedData);

                $this->dispatch('swal',
                    icon: 'success',
                    message: 'শিক্ষার্থীর তথ্য সফলভাবে আপডেট করা হয়েছে!'
                );

                DB::commit();
                return $this->redirect('/students', navigate: true);
            } else {
                // নতুন ডাটা ইনসার্ট লজিক
                Student::create($validatedData);

                $this->dispatch('swal',
                    icon: 'success',
                    message: 'নতুন শিক্ষার্থীর তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!'
                );

                DB::commit();
                $this->reset(); // ফর্ম রিসেট
                return redirect()->route('student.index');
            }

        } catch (\Exception $e) {
            DB::rollBack();

            // কোনো ভুল হলে এরর পপ-আপ দেখাবে
            $this->dispatch('swal',
                icon: 'error',
                message: 'দুঃখিত! তথ্য সংরক্ষণ করা সম্ভব হয়নি।'
            );
        }
    }

    public function render()
    {
        return view('livewire.student-form')
            ->with([
            'classes' => StudentClass::where('is_active', true)
                        ->pluck('class_name', 'id'),
            'bloodGroups' => ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'],
            'genders' => ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'],
            'religions' => ['Islam', 'Hinduism', 'Christianity', 'Buddhism', 'Other'],
        ])->layout('components.layouts.admin');
    }
}
