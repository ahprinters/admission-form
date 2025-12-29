<?php

namespace App\Livewire\Admission\Steps;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Student;
use App\Models\StudentCategoryFlag;

class Step3Category extends Component
{
    public int $studentId;
    public bool $locked = false;

    // DB fields
    public bool $is_working = false;
    public bool $is_landless = false;
    public bool $is_foster = false;
    public bool $is_freedom_fighter_child = false;
    public bool $is_disabled = false;
    public bool $is_orphan = false;
    public bool $is_indigenous = false;
    public bool $is_none = false;

    /**
     * UI map: এখানে add/remove করলে view তে অটো reflect হবে
     */
    public array $options = [
        'is_working' => 'কর্মজীবী',
        'is_landless' => 'ভূমিহীন',
        'is_foster' => 'পোষ্য',
        'is_freedom_fighter_child' => 'মুক্তিযোদ্ধা পোষ্য',
        'is_disabled' => 'প্রতিবন্ধী',
        'is_orphan' => 'এতিম',
        'is_indigenous' => 'উপজাতি',
        'is_none' => 'কোনটিই নয়',
    ];

    public function mount(int $studentId, bool $locked = false): void
    {
        $this->studentId = $studentId;
        $this->locked = $locked;

        $flags = Student::with('categoryFlags')->findOrFail($studentId)->categoryFlags;

        if ($flags) {
            $this->is_working = (bool) $flags->is_working;
            $this->is_landless = (bool) $flags->is_landless;
            $this->is_foster = (bool) $flags->is_foster;
            $this->is_freedom_fighter_child = (bool) $flags->is_freedom_fighter_child;
            $this->is_disabled = (bool) $flags->is_disabled;
            $this->is_orphan = (bool) $flags->is_orphan;
            $this->is_indigenous = (bool) $flags->is_indigenous;
            $this->is_none = (bool) $flags->is_none;
        }

        // consistency
        $this->applyMutualExclusion();
    }

    /**
     * checkbox change হলে mutual exclusion enforce
     */
    public function updated($name, $value): void
    {
        if ($this->locked) return;

        if ($name === 'is_none' && $value === true) {
            // is_none true হলে বাকিগুলো false
            $this->turnOffAllExceptNone();
            return;
        }

        // অন্য কোনোটা true হলে is_none false
        if ($name !== 'is_none' && $value === true) {
            $this->is_none = false;
        }
    }

    protected function rules(): array
    {
        return [
            'is_working' => 'boolean',
            'is_landless' => 'boolean',
            'is_foster' => 'boolean',
            'is_freedom_fighter_child' => 'boolean',
            'is_disabled' => 'boolean',
            'is_orphan' => 'boolean',
            'is_indigenous' => 'boolean',
            'is_none' => 'boolean',
        ];
    }

    private function anySelected(): bool
    {
        return $this->is_working
            || $this->is_landless
            || $this->is_foster
            || $this->is_freedom_fighter_child
            || $this->is_disabled
            || $this->is_orphan
            || $this->is_indigenous
            || $this->is_none;
    }

    private function turnOffAllExceptNone(): void
    {
        $this->is_working = false;
        $this->is_landless = false;
        $this->is_foster = false;
        $this->is_freedom_fighter_child = false;
        $this->is_disabled = false;
        $this->is_orphan = false;
        $this->is_indigenous = false;
        $this->is_none = true;
    }

    private function applyMutualExclusion(): void
    {
        // যদি is_none true থাকে, বাকিগুলো off নিশ্চিত
        if ($this->is_none) {
            $this->turnOffAllExceptNone();
            return;
        }

        // যদি অন্য কোনোটা true থাকে, is_none false নিশ্চিত
        if ($this->is_working || $this->is_landless || $this->is_foster || $this->is_freedom_fighter_child
            || $this->is_disabled || $this->is_orphan || $this->is_indigenous) {
            $this->is_none = false;
        }
    }

    #[On('wizard-save-request')]
    public function onSaveRequest(int $step, string $mode): void
    {
        if ($step !== 3) return;
        $this->save($mode);
    }

    public function save(string $mode = 'next'): void
    {
        if ($this->locked) return;

        $this->validate();
        $this->applyMutualExclusion();

        if (! $this->anySelected()) {
            $this->addError('category', 'কমপক্ষে ১টি ক্যাটাগরি নির্বাচন করুন (অথবা "কোনটিই নয়")।');
            return;
        }

        StudentCategoryFlag::updateOrCreate(
            ['student_id' => $this->studentId],
            [
                'is_working' => $this->is_working,
                'is_landless' => $this->is_landless,
                'is_foster' => $this->is_foster,
                'is_freedom_fighter_child' => $this->is_freedom_fighter_child,
                'is_disabled' => $this->is_disabled,
                'is_orphan' => $this->is_orphan,
                'is_indigenous' => $this->is_indigenous,
                'is_none' => $this->is_none,
            ]
        );

        Student::whereKey($this->studentId)->update(['current_step' => 4]);

        $this->dispatch('wizard-step-saved', savedStep: 3, mode: $mode);
    }

    public function render()
    {
        return view('livewire.admission.steps.step3-category');
    }
}
