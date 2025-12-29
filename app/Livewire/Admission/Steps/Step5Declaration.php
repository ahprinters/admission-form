<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\StudentDeclaration;

class Step5Declaration extends Component
{
    use WithFileUploads;

    public int $studentId;
    public bool $locked = false;

    public ?string $student_commitment = null;
    public ?string $guardian_declaration = null;

    // uploads
    public $student_signature;  // TemporaryUploadedFile
    public $guardian_signature; // TemporaryUploadedFile

    // existing paths (preview)
    public ?string $student_signature_path = null;
    public ?string $guardian_signature_path = null;

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $decl = Student::with('declaration')->findOrFail($studentId)->declaration;

        if ($decl) {
            $this->student_commitment = $decl->student_commitment;
            $this->guardian_declaration = $decl->guardian_declaration;
            $this->student_signature_path = $decl->student_signature_path;
            $this->guardian_signature_path = $decl->guardian_signature_path;
        }
    }

    protected function rules(): array
    {
        return [
            'student_commitment' => 'nullable|string|max:5000',
            'guardian_declaration' => 'nullable|string|max:5000',

            'student_signature' => 'nullable|image|max:1024',  // 1MB
            'guardian_signature' => 'nullable|image|max:1024',
        ];
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 5) return;
        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->validate();

        $data = [
            'student_commitment' => $this->student_commitment,
            'guardian_declaration' => $this->guardian_declaration,
        ];

        // upload signatures if new
        if ($this->student_signature) {
            $data['student_signature_path'] = $this->student_signature->store("admission/{$this->studentId}/signatures", 'public');
        }
        if ($this->guardian_signature) {
            $data['guardian_signature_path'] = $this->guardian_signature->store("admission/{$this->studentId}/signatures", 'public');
        }

        $decl = StudentDeclaration::updateOrCreate(
            ['student_id' => $this->studentId],
            $data
        );

        $this->student_signature_path = $decl->student_signature_path;
        $this->guardian_signature_path = $decl->guardian_signature_path;

        Student::whereKey($this->studentId)->update(['current_step' => 6]);

        $this->dispatch('wizard-step-saved', savedStep: 5, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step5-declaration');
    }
}
