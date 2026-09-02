<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TranscriptRequestController;
use App\Http\Controllers\Admin\TranscriptRequestController as AdminTranscriptRequestController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;
use App\Http\Controllers\Admin\TranscriptController as AdminTranscriptController;
use App\Http\Controllers\TranscriptVerificationController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\SuperAdmin\ProgramController as SuperAdminProgramController;



Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/student/transcript/request', [TranscriptRequestController::class, 'create'])->name('student.transcript.create');
    Route::post('/student/transcript/request', [TranscriptRequestController::class, 'store'])->name('student.transcript.store');
    Route::get('/student/transcript/{id}/payment', [TranscriptRequestController::class, 'payment'])->name('student.transcript.payment');
    Route::post('/student/transcript/{id}/confirm-payment', [TranscriptRequestController::class, 'confirmPayment'])->name('student.transcript.confirm-payment');
    Route::get('/student/transcript/requests', [TranscriptRequestController::class, 'index'])->name('student.transcript.requests');
    Route::get('/student/transcript/{id}/verify-payment', [TranscriptRequestController::class, 'verifyPayment'])->name('student.transcript.verify-payment');
    
   
    Route::prefix('admin')->group(function () {
        Route::get('/transcript-requests', [AdminTranscriptRequestController::class, 'index'])->name('admin.transcript-requests.index');
        Route::get('/transcript-requests/{id}', [AdminTranscriptRequestController::class, 'show'])->name('admin.transcript-requests.show');
        Route::post('/transcript-requests/{id}/update-status', [AdminTranscriptRequestController::class, 'updateStatus'])->name('admin.transcript-requests.update-status');

        Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');

        Route::get('/results', [AdminResultController::class, 'index'])->name('admin.results.index');
        Route::get('/results/{studentId}', [AdminResultController::class, 'create'])->name('admin.results.create');
        Route::post('/results/{studentId}', [AdminResultController::class, 'store'])->name('admin.results.store');
        Route::delete('/results/{id}', [AdminResultController::class, 'destroy'])->name('admin.results.destroy');

        // Disabled for now — application-only workflow, admin processes transcripts
        // manually outside the system. Controller code is left intact for later reuse.
        // Route::post('/transcript-requests/{id}/generate', [AdminTranscriptController::class, 'generate'])->name('admin.transcript.generate');
        // Route::get('/transcript-requests/{id}/download', [AdminTranscriptController::class, 'download'])->name('admin.transcript.download');
    });
});

// Public verification route (no auth needed)
Route::get('/verify/{code}', [TranscriptVerificationController::class, 'verify'])->name('transcript.verify');


Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/admins', [AdminManagementController::class, 'index'])->name('superadmin.admins.index');
    Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('superadmin.admins.create');
    Route::post('/admins', [AdminManagementController::class, 'store'])->name('superadmin.admins.store');
    Route::delete('/admins/{id}', [AdminManagementController::class, 'destroy'])->name('superadmin.admins.destroy');

    Route::get('/programs', [SuperAdminProgramController::class, 'index'])->name('superadmin.programs.index');
    Route::get('/programs/create', [SuperAdminProgramController::class, 'create'])->name('superadmin.programs.create');
    Route::post('/programs', [SuperAdminProgramController::class, 'store'])->name('superadmin.programs.store');
    Route::delete('/programs/{id}', [SuperAdminProgramController::class, 'destroy'])->name('superadmin.programs.destroy');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/student/profile/setup', [StudentProfileController::class, 'create'])->name('student.profile.create');
    Route::post('/student/profile/setup', [StudentProfileController::class, 'store'])->name('student.profile.store');
    // Disabled for now — no transcript file is generated for the student to download
    // until the application-only workflow is revisited. Controller code left intact.
    // Route::get('/student/transcript/{id}/download', [TranscriptRequestController::class, 'download'])->name('student.transcript.download');
});

require __DIR__.'/auth.php';