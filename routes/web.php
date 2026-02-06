<?php

use App\Livewire\HomePage;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\ExamManager;
use App\Livewire\StudentForm;
use App\Livewire\StudentList;
use App\Livewire\CourseManager;
use App\Livewire\Admin\AddClass;
use App\Livewire\SessionManager;
use App\Livewire\SemesterManager;
use App\Livewire\Admin\ClassesIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionPdfController;
use App\Livewire\Admission\StudentAdmissionWizard;
use App\Livewire\Admin\MarqueeManager;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class);
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

    // exam manager
    Route::get('/exams', ExamManager::class)->name('livewire.exam-manager');

    // session manager
    Route::get('/academic-sessions', SessionManager::class)->name('academic-sessions.index');

    // course manager
    Route::get('/courses', CourseManager::class)->name('courses.index');

    //semester manager

    Route::get('/semesters', SemesterManager::class)->name('semesters.index');

    // marquee manager
    Route::get('/admin/marquees', MarqueeManager::class)->name('admin.marquees');


   // DOMPDF
    Route::post('/students/{student}/admission/pdf/generate', [AdmissionPdfController::class, 'generate'])
        ->name('students.admission.pdf.generate');

    Route::get('/students/{student}/admission/pdf/download', [AdmissionPdfController::class, 'download'])
        ->name('students.admission.pdf.download');
});
