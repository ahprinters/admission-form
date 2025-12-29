<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\StudentDocument;

class Step8Documents extends Component
{
    use WithFileUploads;

    public int $studentId;
    public bool $locked = false;

    // uploads
    public $birth_cert;
    public $nid;
    public $tc;
    public $certificate;
    public $fee_slip;

    // existing
    public array $existing = []; // type => [path, label]

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $docs = Student::with('documents')->findOrFail($studentId)->documents;
        foreach ($docs as $d) {
            $this->existing[$d->type] = ['path' => $d->path, 'label' => $d->label];
        }
    }

    protected function rules(): array
    {
        return [
            'birth_cert' => 'nullable|file|max:4096',
            'nid'        => 'nullable|file|max:4096',
            'tc'         => 'nullable|file|max:4096',
            'certificate'=> 'nullable|file|max:4096',
            'fee_slip'   => 'nullable|file|max:4096',
        ];
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 8) return;
        $this->save($mode);
    }

    private function upsertDoc(string $type, string $label, $file): void
    {
        if (! $file) return;

        $path = $file->store("admission/{$this->studentId}/documents", 'public');

        StudentDocument::updateOrCreate(
            ['student_id' => $this->studentId, 'type' => $type],
            ['label' => $label, 'path' => $path]
        );

        $this->existing[$type] = ['path' => $path, 'label' => $label];
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->validate();

        $this->upsertDoc('birth_cert', 'Online Birth Certificate', $this->birth_cert);
        $this->upsertDoc('nid', 'NID (if any)', $this->nid);
        $this->upsertDoc('tc', 'Previous Institution Transfer Certificate', $this->tc);
        $this->upsertDoc('certificate', 'Certificate', $this->certificate);
        $this->upsertDoc('fee_slip', 'Admission Fee Slip', $this->fee_slip);

        // Step-8 শেষ, তাই current_step 8 থাকলেও সমস্যা নেই
        Student::whereKey($this->studentId)->update(['current_step' => 8]);

        // Step-8 এ next নেই; draft/next দুটোই wizard কে জানাই
        $this->dispatch('wizard-step-saved', savedStep: 8, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step8-documents');
    }
}
