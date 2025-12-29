<?php

namespace App\Livewire\Admission;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentAdmissionWizard extends Component
{
    public Student $student;

    // Wizard steps: 2..8 (Step-1 আলাদা: StudentForm)
    public int $step = 2;

    private int $minStep = 2;
    private int $maxStep = 8;

    public function mount(Student $student): void
    {
        $this->student = $student;

        $current = (int) ($this->student->current_step ?: $this->minStep);
        $this->step = $this->clampStep($current);
    }

    public function getLockedProperty(): bool
    {
        return $this->student->status === 'submitted';
    }

    private function clampStep(int $step): int
    {
        return max($this->minStep, min($this->maxStep, $step));
    }

    public function goToStep(int $to): void
    {
        if ($this->locked) return;

        $to = $this->clampStep($to);
        $this->step = $to;

        $this->student->update(['current_step' => $this->step]);
    }

    public function back(): void
    {
        if ($this->locked) return;

        if ($this->step > $this->minStep) {
            $this->goToStep($this->step - 1);
        }
    }

    /**
     * Request save from wizard footer
     * $mode: next | draft
     */
    public function requestSave(string $mode): void
    {
        if ($this->locked) return;

        $mode = strtolower(trim($mode));
        if (! in_array($mode, ['next', 'draft'], true)) {
            $mode = 'next';
        }

        // ✅ Draft only allowed on last step (extra safety)
        if ($mode === 'draft' && $this->step !== $this->maxStep) {
            return;
        }

        // Step component will listen and save itself
        $this->dispatch('wizard-save-request', step: $this->step, mode: $mode);
    }

    /**
     * Step components dispatch: wizard-step-saved(savedStep, mode)
     */
    #[On('wizard-step-saved')]
    public function onStepSaved(int $savedStep, string $mode = 'next'): void
    {
        $savedStep = $this->clampStep($savedStep);
        $mode = strtolower(trim($mode));

        if ($mode === 'next') {
            $this->goToStep($this->clampStep($savedStep + 1));
            return;
        }

        // draft
        $this->dispatch('toast', message: 'Draft saved!');
    }

    /**
     * Final submit (lock the wizard)
     * Runs only from Step-8 footer button
     */
    public function finalSubmit(): void
    {
        if ($this->locked) return;

        // (Optional) enforce last step only
        if ($this->step !== $this->maxStep) {
            $this->dispatch('toast', message: 'Final submit শুধু শেষ ধাপে করা যাবে।');
            return;
        }

        DB::transaction(function () {
            $this->student->update([
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);
        });

        // ✅ refresh so locked updates instantly
        $this->student->refresh();

        $this->dispatch('toast', message: 'Final submit complete!');
    }

    public function render()
    {
        return view('livewire.admission.student-admission-wizard')
            ->layout('components.layouts.admin');
    }
}
