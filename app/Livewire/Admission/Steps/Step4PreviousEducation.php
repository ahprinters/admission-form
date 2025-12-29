<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\StudentEducation;

class Step4PreviousEducation extends Component
{
    public int $studentId;
    public bool $locked = false;

    /**
     * Dynamic rows:
     * [
     *   ['institution_name'=>..., 'class_name'=>..., 'pass_year'=>..., 'gpa'=>..., 'transfer_certificate_no'=>..., 'transfer_certificate_date'=>...],
     * ]
     */
    public array $rows = [];

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $existing = Student::with('educations')->findOrFail($studentId)->educations;

        if ($existing->count()) {
            $this->rows = $existing->map(fn ($e) => [
                'institution_name' => $e->institution_name,
                'class_name' => $e->class_name,
                'pass_year' => $e->pass_year,
                'gpa' => $e->gpa,
                'transfer_certificate_no' => $e->transfer_certificate_no,
                'transfer_certificate_date' => optional($e->transfer_certificate_date)->format('Y-m-d'),
            ])->toArray();
        } else {
            $this->rows = [$this->blankRow()];
        }
    }

    private function blankRow(): array
    {
        return [
            'institution_name' => '',
            'class_name' => '',
            'pass_year' => '',
            'gpa' => '',
            'transfer_certificate_no' => '',
            'transfer_certificate_date' => '',
        ];
    }

    public function addRow(): void
    {
        if ($this->locked) return;
        $this->rows[] = $this->blankRow();
    }

    public function removeRow(int $index): void
    {
        if ($this->locked) return;

        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);

        if (count($this->rows) === 0) {
            $this->rows[] = $this->blankRow();
        }
    }

    protected function rules(): array
    {
        return [
            'rows' => 'array|min:1',

            'rows.*.institution_name' => 'nullable|string|min:2|max:255',
            'rows.*.class_name' => 'nullable|string|max:100',
            'rows.*.pass_year' => 'nullable|integer|min:1950|max:2100',
            'rows.*.gpa' => 'nullable|string|max:20',
            'rows.*.transfer_certificate_no' => 'nullable|string|max:100',
            'rows.*.transfer_certificate_date' => 'nullable|date',
        ];
    }

    private function hasAtLeastOneMeaningfulRow(): bool
    {
        foreach ($this->rows as $r) {
            $hasSomething =
                trim((string)($r['institution_name'] ?? '')) !== '' ||
                trim((string)($r['class_name'] ?? '')) !== '' ||
                trim((string)($r['pass_year'] ?? '')) !== '' ||
                trim((string)($r['gpa'] ?? '')) !== '' ||
                trim((string)($r['transfer_certificate_no'] ?? '')) !== '' ||
                trim((string)($r['transfer_certificate_date'] ?? '')) !== '';

            if ($hasSomething) return true;
        }
        return false;
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 4) return;
        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->resetErrorBag('rows_error');
        $this->validate();

        if (! $this->hasAtLeastOneMeaningfulRow()) {
            $this->addError('rows_error', 'কমপক্ষে ১টি পূর্ব অধ্যয়নের তথ্য দিন (অথবা অন্তত ১টি ফিল্ড পূরণ করুন)।');
            return;
        }

        DB::transaction(function () {
            StudentEducation::where('student_id', $this->studentId)->delete();

            $sort = 1;
            foreach ($this->rows as $r) {
                $allEmpty =
                    trim((string)($r['institution_name'] ?? '')) === '' &&
                    trim((string)($r['class_name'] ?? '')) === '' &&
                    trim((string)($r['pass_year'] ?? '')) === '' &&
                    trim((string)($r['gpa'] ?? '')) === '' &&
                    trim((string)($r['transfer_certificate_no'] ?? '')) === '' &&
                    trim((string)($r['transfer_certificate_date'] ?? '')) === '';

                if ($allEmpty) continue;

                StudentEducation::create([
                    'student_id' => $this->studentId,
                    'institution_name' => ($r['institution_name'] ?? '') ?: null,
                    'class_name' => ($r['class_name'] ?? '') ?: null,
                    'pass_year' => ($r['pass_year'] ?? '') ?: null,
                    'gpa' => ($r['gpa'] ?? '') ?: null,
                    'transfer_certificate_no' => ($r['transfer_certificate_no'] ?? '') ?: null,
                    'transfer_certificate_date' => ($r['transfer_certificate_date'] ?? '') ?: null,
                    'sort_order' => $sort++,
                ]);
            }

            Student::whereKey($this->studentId)->update(['current_step' => 5]);
        });

        $this->dispatch('wizard-step-saved', savedStep: 4, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step4-previous-education', [
            'locked' => $this->locked,
        ]);
    }
}
