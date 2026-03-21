<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionPdfController;

// Livewire Components
use App\Livewire\HomePage;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

use App\Livewire\ExamManager;
use App\Livewire\StudentForm;
use App\Livewire\StudentList;
use App\Livewire\CourseManager;
use App\Livewire\SessionManager;
use App\Livewire\SemesterManager;

use App\Livewire\Admin\AddClass;
use App\Livewire\Admin\ClassesIndex;
use App\Livewire\Admin\MarqueeManager;
use App\Livewire\Admin\MediaManager;

// Admission
use App\Livewire\Admission\StudentAdmissionWizard;

// Fee Management
use App\Livewire\Admin\FeeCollection;
use App\Livewire\Admin\FeeAssign;

// Media Management
// use App\Livewire\Carousel;
use App\Livewire\Gallery;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomePage::class)->name('home');

// Optional: keep this only if you want a separate carousel page for testing/preview
// Route::get('/carousel', Carousel::class)->name('carousel');

// Public gallery page from navbar
Route::get('/gallery', Gallery::class)->name('gallery');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('auth.register');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin + Accountant Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin,accountant')
        ->group(function () {

            // Class / Basic Admin
            Route::get('/class/create', AddClass::class)->name('class.create');
            Route::get('/classes', ClassesIndex::class)->name('classes.index');
            Route::get('/marquees', MarqueeManager::class)->name('marquees');

            // Media Management
            Route::get('/media', MediaManager::class)->name('media.index');

            // Fee Management
            Route::get('/fees', FeeCollection::class)->name('fees.index');
            Route::get('/fees/assign', FeeAssign::class)->name('fees.assign');

            // Reports (future)
            // Route::get('/reports', FinanceReport::class)->name('reports.index');
        });

    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    Route::get('/students', StudentList::class)->name('student.index');
    Route::get('/student/create', StudentForm::class)->name('student.create');
    Route::get('/student/edit/{id}', StudentForm::class)->name('student.edit');

    Route::get('/students/{student}/admission', StudentAdmissionWizard::class)
        ->name('students.admission');

    /*
    |--------------------------------------------------------------------------
    | Academic
    |--------------------------------------------------------------------------
    */

    Route::get('/exams', ExamManager::class)->name('exam.index');
    Route::get('/academic-sessions', SessionManager::class)->name('academic-sessions.index');
    Route::get('/courses', CourseManager::class)->name('courses.index');
    Route::get('/semesters', SemesterManager::class)->name('semesters.index');

    Route::view('/attendance', 'attendance.page')->name('attendance.hub');

    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */

    Route::post('/students/{student}/admission/pdf/generate', [AdmissionPdfController::class, 'generate'])
        ->name('students.admission.pdf.generate');

    Route::get('/students/{student}/admission/pdf/download', [AdmissionPdfController::class, 'download'])
        ->name('students.admission.pdf.download');
});
