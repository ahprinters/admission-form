<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StudentForm extends Component
{
    public $studentId;

    public $name_en, $name_bn, $email, $class, $roll_number, $gender;
    public $phone, $date_of_birth, $nid_birth_certificate, $blood_group;
    public $nationality = 'Bangladeshi', $religion, $address, $is_active = true;

    protected function rules()
    {
        return [
            'name_en' => 'required|min:3',
            'name_bn' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('students', 'email')->ignore($this->studentId)],
            'class' => 'required',
            'roll_number' => 'required',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'nullable|date',
            'nid_birth_certificate' => 'nullable|string',
            'blood_group' => 'required',
            'religion' => 'required',
            'nationality' => 'nullable|string',
            'address' => 'nullable|string',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $student = Student::findOrFail($id);
            $this->studentId = $student->id;
            $this->fill($student->toArray());
        }
    }
    public function submit()
{
    $validated = $this->validate();

    DB::beginTransaction();

    try {
        if ($this->studentId) {
            $student = Student::findOrFail($this->studentId);

            // যদি already submitted হয়, এডিট ব্লক করতে চাইলে:
            if ($student->status === 'submitted') {
                DB::rollBack();

                $this->dispatch('toast', type: 'error', message: 'এই আবেদনটি লক করা আছে। এডিট করা যাবে না।');
                return;
            }

            $student->update($validated);
        } else {
            // ✅ নতুন Student create
            $student = Student::create($validated);
        }

        // ✅ MUST: Step-2 এ যাওয়ার জন্য current_step সেট করুন
        $student->update([
            'current_step' => 2,
            // status না থাকলে চাইলে default দিন
            'status' => $student->status ?: 'draft',
        ]);

        DB::commit();

        // ✅ Step-2 Wizard page এ redirect
        return redirect()->route('students.admission', $student->id);

        } catch (\Throwable $e) {
        DB::rollBack();

        logger()->error('Student create/update failed', [
            'error' => $e->getMessage(),
        ]);

            $this->dispatch('toast', type: 'error', message: 'তথ্য সংরক্ষণ করা যায়নি। আবার চেষ্টা করুন।');
        }
    }



    public function render()
    {
        return view('livewire.student-form', [
            'classes' => StudentClass::where('is_active', true)
                ->pluck('class_name', 'class_name'),

            'bloodGroups' => ['A+','A-','B+','B-','O+','O-','AB+','AB-'],

            'genders' => [
                'male' => 'Male',
                'female' => 'Female',
            ],

            'religions' => [
                'Islam' => 'Islam',
                'Hinduism' => 'Hinduism',
                'Christianity' => 'Christianity',
                'Buddhism' => 'Buddhism',
            ],
        ])->layout('components.layouts.admin');
    }
}
