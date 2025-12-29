<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\StudentOfficeEntry;

class Step7Office extends Component
{
    use WithFileUploads;

    public int $studentId;
    public bool $locked = false;

    public $class_teacher_name;
    public $accountant_name;

    public $session_fee;
    public $admission_fee;
    public $monthly_fee_jan;
    public $misc_fee;

    public $principal_comment;

    // uploads
    public $class_teacher_signature;
    public $accountant_signature;
    public $principal_signature;

    // existing paths
    public ?string $class_teacher_signature_path = null;
    public ?string $accountant_signature_path = null;
    public ?string $principal_signature_path = null;

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $entry = Student::with('officeEntry')->findOrFail($studentId)->officeEntry;
        if ($entry) {
            $this->class_teacher_name = $entry->class_teacher_name;
            $this->accountant_name = $entry->accountant_name;

            $this->session_fee = $entry->session_fee;
            $this->admission_fee = $entry->admission_fee;
            $this->monthly_fee_jan = $entry->monthly_fee_jan;
            $this->misc_fee = $entry->misc_fee;

            $this->principal_comment = $entry->principal_comment;

            $this->class_teacher_signature_path = $entry->class_teacher_signature_path;
            $this->accountant_signature_path = $entry->accountant_signature_path;
            $this->principal_signature_path = $entry->principal_signature_path;
        }
    }

    protected function rules(): array
    {
        return [
            'class_teacher_name' => 'nullable|string|max:255',
            'accountant_name' => 'nullable|string|max:255',

            'session_fee' => 'nullable|numeric|min:0',
            'admission_fee' => 'nullable|numeric|min:0',
            'monthly_fee_jan' => 'nullable|numeric|min:0',
            'misc_fee' => 'nullable|numeric|min:0',

            'principal_comment' => 'nullable|string|max:2000',

            'class_teacher_signature' => 'nullable|image|max:1024',
            'accountant_signature' => 'nullable|image|max:1024',
            'principal_signature' => 'nullable|image|max:1024',
        ];
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 7) return;
        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->validate();

        $data = [
            'class_teacher_name' => $this->class_teacher_name,
            'accountant_name' => $this->accountant_name,

            'session_fee' => $this->session_fee,
            'admission_fee' => $this->admission_fee,
            'monthly_fee_jan' => $this->monthly_fee_jan,
            'misc_fee' => $this->misc_fee,

            'principal_comment' => $this->principal_comment,
        ];

        if ($this->class_teacher_signature) {
            $data['class_teacher_signature_path'] = $this->class_teacher_signature->store("admission/{$this->studentId}/office", 'public');
        }
        if ($this->accountant_signature) {
            $data['accountant_signature_path'] = $this->accountant_signature->store("admission/{$this->studentId}/office", 'public');
        }
        if ($this->principal_signature) {
            $data['principal_signature_path'] = $this->principal_signature->store("admission/{$this->studentId}/office", 'public');
        }

        $entry = StudentOfficeEntry::updateOrCreate(['student_id' => $this->studentId], $data);

        $this->class_teacher_signature_path = $entry->class_teacher_signature_path;
        $this->accountant_signature_path = $entry->accountant_signature_path;
        $this->principal_signature_path = $entry->principal_signature_path;

        Student::whereKey($this->studentId)->update(['current_step' => 8]);

        $this->dispatch('wizard-step-saved', savedStep: 7, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step7-office');
    }
}
