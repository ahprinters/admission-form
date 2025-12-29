<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\StudentAdmissionForm;
use App\Services\AdmissionPdfService;

class Step6Pdf extends Component
{
    use WithFileUploads;

    public int $studentId;
    public bool $locked = false;

    public ?Student $student = null;

    public ?string $generated_pdf_path = null;
    public ?string $signed_pdf_path = null;

    public $signed_pdf;

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $this->student = Student::findOrFail($studentId);

        $form = StudentAdmissionForm::where('student_id', $studentId)->first();
        if ($form) {
            $this->generated_pdf_path = $form->generated_pdf_path;
            $this->signed_pdf_path = $form->signed_pdf_path;
        }
    }

    protected function rules(): array
    {
        return [
            'signed_pdf' => 'nullable|file|mimes:pdf|max:4096',
        ];
    }

    /**
     * ✅ Locked হলেও PDF generate allow (এটা edit না)
     */
    public function generatePdf(AdmissionPdfService $service): void
    {
        $student = Student::findOrFail($this->studentId);

        $path = $service->generateAndStore($student); // must return a path in public disk

        $form = StudentAdmissionForm::updateOrCreate(
            ['student_id' => $this->studentId],
            ['generated_pdf_path' => $path]
        );

        $this->generated_pdf_path = $form->generated_pdf_path;

        $this->dispatch('toast', message: 'PDF generated successfully!');
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 6) return;
        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return; // ✅ signed upload/save locked থাকলে বন্ধ

        $this->validate();

        $data = [];
        if ($this->signed_pdf) {
            $data['signed_pdf_path'] = $this->signed_pdf->store("admission/{$this->studentId}/form", 'public');
        }

        $form = StudentAdmissionForm::updateOrCreate(
            ['student_id' => $this->studentId],
            $data
        );

        $this->signed_pdf_path = $form->signed_pdf_path;

        Student::whereKey($this->studentId)->update(['current_step' => 7]);

        $this->dispatch('wizard-step-saved', savedStep: 6, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step6-pdf', [
            'locked'  => $this->locked,
            'student' => $this->student,
        ]);
    }
}
