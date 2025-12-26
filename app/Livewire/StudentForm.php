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
            Student::findOrFail($this->studentId)->update($validatedData);

            DB::commit();

            // ✅ Flash message
            session()->flash('success', 'শিক্ষার্থীর তথ্য সফলভাবে আপডেট করা হয়েছে!');

            // ✅ Redirect (no chaining)
            return $this->redirectRoute('student.index', navigate: true);
        }

        Student::create($validatedData);

        DB::commit();

        // ✅ Flash message
        session()->flash('success', 'নতুন শিক্ষার্থীর তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!');

        // ✅ Redirect (no chaining)
        return $this->redirectRoute('student.index', navigate: true);

    } catch (\Exception $e) {
        DB::rollBack();

        logger()->error('Student save failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        $this->dispatch('swal',
            icon: 'error',
            message: 'শিক্ষার্থীর তথ্য সংরক্ষণ করতে ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।'
        );
    }
}


   public function render()
{
    $blood = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

    return view('livewire.student-form')->with([
        'classes' => StudentClass::where('is_active', true)
            ->pluck('class_name', 'class_name'),

        'bloodGroups' => array_combine($blood, $blood), // ✅ associative

        'genders' => ['male' => 'Male', 'female' => 'Female'],

        'religions' => [
            'Islam' => 'Islam',
            'Hinduism' => 'Hinduism',
            'Christianity' => 'Christianity',
            'Buddhism' => 'Buddhism',
            'Other' => 'Other',
        ],
    ])->layout('components.layouts.admin');
}

}
