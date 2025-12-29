<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\StudentForm;
use App\Livewire\Admin\ClassesIndex;
use App\Livewire\Admin\AddClass;
use App\Livewire\StudentList;
use App\Livewire\Admission\StudentAdmissionWizard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionPdfController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/admin/class/create', AddClass::class)->name('admin.class.create');
    Route::get('/admin/classes', ClassesIndex::class)->name('admin.classes.index');

    Route::view('/attendance', 'attendance.page')->name('attendance.hub');

    // Students
    Route::get('/students', StudentList::class)->name('student.index');
    Route::get('/student/create', StudentForm::class)->name('student.create');
    Route::get('/student/edit/{id}', StudentForm::class)->name('student.edit');

    // Admission Wizard (Step-2..8)
    Route::get('/students/{student}/admission', StudentAdmissionWizard::class)
        ->name('students.admission');

   // DOMPDF
    Route::post('/students/{student}/admission/pdf/generate', [AdmissionPdfController::class, 'generate'])
        ->name('students.admission.pdf.generate');

    Route::get('/students/{student}/admission/pdf/download', [AdmissionPdfController::class, 'download'])
        ->name('students.admission.pdf.download');
});
