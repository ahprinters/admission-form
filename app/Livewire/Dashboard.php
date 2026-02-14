<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('components.layouts.admin')]

class Dashboard extends Component
{
    use WithPagination;

    // সার্চ প্রোপার্টি
    public $search = '';

    // সার্চ ইনপুটে টাইপ করলে পেজিনেশন রিসেট হবে
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        $today = Carbon::today();

        // সার্চ লজিক অনুযায়ী শিক্ষার্থীদের ডাটা ফিল্টার (যদি ড্যাশবোর্ডে লিস্ট দেখান)
        $students = Student::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name_en', 'like', "%{$this->search}%")
                    ->orWhere('roll_number', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%");
                        });
                    })
                    ->latest()
                    ->paginate(5); // ড্যাশবোর্ডের জন্য ছোট লিস্ট
            $totalStudents = Student::count();
            $todayAttendance = Attendance::whereDate('created_at', $today)->count();

        return view('livewire.dashboard', [
            // স্ট্যাটাস কার্ডের ডাটা
            'totalStudents' => $totalStudents,
            'activeStudents' => Student::where('is_active', true)->count(), // আপনার ডাটাবেস কলাম অনুযায়ী 'is_active' বা 'status' ব্যবহার করুন
            'totalTeachers' => Teacher::count(),
            'newStudentsToday' => Student::whereDate('created_at', $today)->count(),
            'newTeachersToday' => Teacher::whereDate('created_at', $today)->count(),

            // উপস্থিতির তথ্য
            'todayTotal' => $todayAttendance,
            'attendanceRate' => $totalStudents > 0
            ? round(($todayAttendance / $totalStudents) * 100) : 0, // ভবিষ্যতে ডাইনামিক করতে পারেন
            'todayRate' => 85,

            // ফি তথ্য (উদাহরণস্বরূপ ডাইনামিক সাম হতে পারে)
            'monthlyFees' => 55000,
            'todayFees' => 1200,

            // ফিল্টার করা স্টুডেন্ট লিস্ট (যদি ড্যাশবোর্ডের মেইন কন্টেন্টে দেখাতে চান)
            'students' => $students,
        ]);
    }
}
