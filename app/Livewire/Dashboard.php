<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance; // আপনার মডেল অনুযায়ী নাম পরিবর্তন করুন
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $today = Carbon::today();

        return view('livewire.dashboard', [
            'totalStudents' => Student::count(),
            'activeStudents' => Student::where('status', 'active')->count(),
            'totalTeachers' => Teacher::count(),
            'newStudentsToday' => Student::whereDate('created_at', $today)->count(),
            'newTeachersToday' => Teacher::whereDate('created_at', $today)->count(),

            // ফি এবং উপস্থিতির লজিক (উদাহরণস্বরূপ)
            'monthlyFees' => 55000, // এখানে ফি মডেলের সাম (sum) হবে
            'todayFees' => 1200,
            'attendanceRate' => 92,
            'todayRate' => 85,
            'todayTotal' => Attendance::whereDate('created_at', $today)->count(),
        ])->layout('components.layouts.admin'); // আপনার এডমিন লেআউট ব্যবহার করুন
    }
}
