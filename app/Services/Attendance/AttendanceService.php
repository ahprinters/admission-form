<?php

namespace App\Services\Attendance;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    /**
     * Students are stored with `students.class` (string column).
     * In this project that value comes from StudentClass `id`.
     */
    public function getStudentsByClassId(int $classId): Collection
    {
        return Student::query()
            ->where('is_active', true)
            ->where('class', (string)$classId)
            ->orderBy('roll_number')
            ->get();
    }

    public function getAttendanceByDateAndClassId(string $date, int $classId): Collection
    {
        $studentIds = $this->getStudentsByClassId($classId)->pluck('id');

        return Attendance::query()
            ->whereIn('student_id', $studentIds)
            ->whereDate('date', $date)
            ->get();
    }

    public function getStudent(int $studentId): ?Student
    {
        return Student::query()->find($studentId);
    }

    public function getAttendanceHistoryByStudent(int $studentId, int $limit = 120): Collection
    {
        return Attendance::query()
            ->where('student_id', $studentId)
            ->orderByDesc('date')
            ->limit($limit)
            ->get();
    }

    public function getAbsentAttendanceByStudent(int $studentId, int $limit = 120): Collection
    {
        return Attendance::query()
            ->where('student_id', $studentId)
            ->where('status', false)
            ->orderByDesc('date')
            ->limit($limit)
            ->get();
    }

    /**
     * Bulk upsert attendance for a given date.
     * Unique key is (student_id, date) as per migration.
     *
     * @param array<int,int|bool> $statusByStudentId   [student_id => 0/1]
     * @param array<int,string|null> $remarksByStudentId [student_id => remarks]
     */
    public function upsertDailyAttendance(string $date, array $statusByStudentId, array $remarksByStudentId = []): void
    {
        DB::transaction(function () use ($date, $statusByStudentId, $remarksByStudentId) {
            $rows = [];
            foreach ($statusByStudentId as $studentId => $status) {
                $rows[] = [
                    'student_id' => (int)$studentId,
                    'date' => $date,
                    'status' => (bool)$status,
                    'remarks' => $remarksByStudentId[(int)$studentId] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Attendance::upsert(
                $rows,
                ['student_id', 'date'],
                ['status', 'remarks', 'updated_at']
            );
        });
    }

    /**
     * Adjust: mark selected attendance rows as present.
     */
    public function markPresentByIds(array $ids): void
    {
        if (empty($ids)) return;

        Attendance::query()
            ->whereIn('id', $ids)
            ->update([
                'status' => true,
                'updated_at' => now(),
            ]);
    }
}
