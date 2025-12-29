<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Student;
use App\Models\StudentGuardian;

class Step2Guardian extends Component
{
    public int $studentId;
    public bool $locked = false;

    public $father_name_en, $father_name_bn, $father_mobile;
    public $mother_name_en, $mother_name_bn, $mother_mobile;

    public $guardian_name, $guardian_relation, $guardian_mobile, $whatsapp;

    public $occupation, $annual_income, $land_amount, $family_members;
    public $permanent_address, $present_address, $children_in_madrasa;

    public array $occupationOptions = [
        'agriculture' => 'কৃষি',
        'worker' => 'শ্রমিক',
        'business' => 'ব্যবসায়ী',
        'small_business' => 'ক্ষুদ্র ব্যবসায়ী',
        'govt_job' => 'সরকারি চাকুরিজীবী',
        'private_job' => 'বেসরকারি চাকুরিজীবী',
        'doctor' => 'চিকিৎসক',
        'lawyer' => 'আইনজীবী',
        'teacher' => 'শিক্ষক',
        'fisherman' => 'জেলে',
        'weaver' => 'তাতী',
        'blacksmith' => 'কামার',
        'potter' => 'কুমার',
        'expat' => 'প্রবাসী',
    ];

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $guardian = Student::with('guardian')->findOrFail($studentId)->guardian;

        if ($guardian) {
            $this->father_name_en = $guardian->father_name_en;
            $this->father_name_bn = $guardian->father_name_bn;
            $this->father_mobile  = $guardian->father_mobile;

            $this->mother_name_en = $guardian->mother_name_en;
            $this->mother_name_bn = $guardian->mother_name_bn;
            $this->mother_mobile  = $guardian->mother_mobile;

            $this->guardian_name     = $guardian->guardian_name;
            $this->guardian_relation = $guardian->guardian_relation;
            $this->guardian_mobile   = $guardian->guardian_mobile;
            $this->whatsapp          = $guardian->whatsapp;

            $this->occupation     = $guardian->occupation;
            $this->annual_income  = $guardian->annual_income;
            $this->land_amount    = $guardian->land_amount;
            $this->family_members = $guardian->family_members;

            $this->permanent_address   = $guardian->permanent_address;
            $this->present_address     = $guardian->present_address;
            $this->children_in_madrasa = $guardian->children_in_madrasa;
        }
    }

    protected function rules(): array
    {
        return [
            'father_name_en' => 'required|min:2',
            'father_mobile'  => 'required|string|max:20',

            'mother_name_en' => 'required|min:2',
            'mother_mobile'  => 'required|string|max:20',

            'whatsapp'       => 'nullable|string|max:20',
            'occupation'     => 'nullable|string',
            'annual_income'  => 'nullable|numeric|min:0',
            'family_members' => 'nullable|integer|min:1|max:99',
            'children_in_madrasa' => 'nullable|integer|min:0|max:30',
        ];
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        // Parent wizard থেকে যে step save request এসেছে সেটা Step-2 কিনা
        if ($step !== 2) return;

        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->validate();

        StudentGuardian::updateOrCreate(
            ['student_id' => $this->studentId],
            [
                'father_name_en' => $this->father_name_en,
                'father_name_bn' => $this->father_name_bn,
                'father_mobile'  => $this->father_mobile,

                'mother_name_en' => $this->mother_name_en,
                'mother_name_bn' => $this->mother_name_bn,
                'mother_mobile'  => $this->mother_mobile,

                'guardian_name'     => $this->guardian_name,
                'guardian_relation' => $this->guardian_relation,
                'guardian_mobile'   => $this->guardian_mobile,
                'whatsapp'          => $this->whatsapp,

                'occupation'     => $this->occupation,
                'annual_income'  => $this->annual_income,
                'land_amount'    => $this->land_amount,
                'family_members' => $this->family_members,

                'permanent_address'   => $this->permanent_address,
                'present_address'     => $this->present_address,
                'children_in_madrasa' => $this->children_in_madrasa,
            ]
        );

        // progress update
        Student::whereKey($this->studentId)->update(['current_step' => 3]);

        // Parent wizard কে জানানো
        $this->dispatch('wizard-step-saved', savedStep: 2, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step2-guardian');
    }
}
