<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use App\Services\Attendance\AttendanceService;
use App\Models\StudentClass;

/**
 * Single-page Attendance Hub (Livewire v3)
 *
 * Modes:
 *  - class   : take attendance for a class on a date (toggle)
 *  - student : view a single student's history
 *  - adjust  : mark selected absent rows as present for a student
 */
class Hub extends Component
{
    #[Url(as: 'mode')]
    public string $mode = 'class'; // class|student|adjust

    #[Url(as: 'class')]
    public int $classId = 0;

    #[Url(as: 'date')]
    public string $date = '';

    #[Url(as: 'student')]
    public int $studentId = 0;

    /** UI lists */
    public array $classOptions = []; // [id => name]
    public array $students = [];     // rows for class mode

    /** Form state */
    public array $statusByStudent = [];  // [student_id => 0/1]
    public array $remarksByStudent = []; // [student_id => remarks]

    /** Student/Adjust data */
    public array $attendances = [];
    public array $selectedAdjustIds = [];

    protected AttendanceService $attendance;

    public function boot(AttendanceService $attendance): void
{
    $this->attendance = $attendance;
}

    public function mount(): void
    {
        $this->date = $this->date ?: now()->toDateString();

        $this->classOptions = StudentClass::query()
            ->where('is_active', true)
            ->orderBy('class_name')
            ->pluck('class_name', 'id')
            ->toArray();

        // default class (first active class)
        if ($this->classId <= 0 && !empty($this->classOptions)) {
            $this->classId = (int) array_key_first($this->classOptions);
        }

        $this->load();
    }

    public function updated($name): void
    {
        if (in_array($name, ['mode', 'classId', 'date', 'studentId'], true)) {
            $this->load();
        }
    }

    public function load(): void
    {
        $this->students = [];
        $this->statusByStudent = [];
        $this->remarksByStudent = [];
        $this->attendances = [];
        $this->selectedAdjustIds = [];

        if ($this->mode === 'class') {
            $this->loadClassMode();
            return;
        }

        if ($this->mode === 'student') {
            $this->loadStudentMode();
            return;
        }

        if ($this->mode === 'adjust') {
            $this->loadAdjustMode();
            return;
        }
    }

    private function loadClassMode(): void
    {
        if ($this->classId <= 0) return;

        $students = $this->attendance->getStudentsByClassId($this->classId);
        $existing = $this->attendance->getAttendanceByDateAndClassId($this->date, $this->classId)
            ->keyBy('student_id');

        $this->students = $students->map(fn($s) => [
            'id' => (int) $s->id,
            'name' => $s->name_en,
            'roll' => $s->roll_number,
        ])->values()->all();

        foreach ($this->students as $row) {
            $sid = (int) $row['id'];
            $rec = $existing->get($sid);
            $this->statusByStudent[$sid] = $rec ? (int) ((bool)$rec->status) : 0;
            $this->remarksByStudent[$sid] = $rec?->remarks;
        }
    }

    private function loadStudentMode(): void
    {
        if ($this->studentId <= 0) return;

        $list = $this->attendance->getAttendanceHistoryByStudent($this->studentId);
        $this->attendances = $list->map(fn($a) => [
            'id' => (int)$a->id,
            'date' => (string)$a->date,
            'status' => (bool)$a->status,
            'remarks' => $a->remarks,
        ])->all();
    }

    private function loadAdjustMode(): void
    {
        if ($this->studentId <= 0) return;

        $list = $this->attendance->getAbsentAttendanceByStudent($this->studentId);
        $this->attendances = $list->map(fn($a) => [
            'id' => (int)$a->id,
            'date' => (string)$a->date,
            'status' => (bool)$a->status,
            'remarks' => $a->remarks,
        ])->all();
    }

    public function saveClassAttendance(): void
    {
        if ($this->classId <= 0) return;

        $this->validate([
            'date' => ['required', 'date'],
            'statusByStudent' => ['array'],
            'statusByStudent.*' => ['in:0,1'],
            'remarksByStudent' => ['array'],
            'remarksByStudent.*' => ['nullable', 'string', 'max:255'],
        ]);

        $this->attendance->upsertDailyAttendance($this->date, $this->statusByStudent, $this->remarksByStudent);

        $this->dispatch('toast', type: 'success', message: 'Attendance saved');
        $this->loadClassMode();
    }

    public function applyAdjust(): void
    {
        $ids = array_values(array_filter($this->selectedAdjustIds));
        if (empty($ids)) {
            $this->addError('selectedAdjustIds', 'Select at least one item.');
            return;
        }

        $this->attendance->markPresentByIds($ids);
        $this->dispatch('toast', type: 'success', message: 'Adjusted successfully');
        $this->loadAdjustMode();
    }

    public function switchToAdjust(int $studentId): void
    {
        $this->studentId = $studentId;
        $this->mode = 'adjust';
        $this->load();
    }

    public function render()
    {
        return view('livewire.attendance.hub');
    }
}
