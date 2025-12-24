<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\StudentForm;
use App\Livewire\StudentList;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// লগইন রাউট (গেস্টদের জন্য)
    Route::get('/login', Login::class)->name('login')->middleware('guest');

// ড্যাশবোর্ড এবং স্টুডেন্ট রাউট (শুধুমাত্র লগইন করা ইউজারদের জন্য)
    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/students', StudentList::class)->name('student.index');
    Route::get('/student/create', StudentForm::class)->name('student.create');
    Route::get('/student/edit/{id}', StudentForm::class)->name('student.edit');
});
