<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\OrganizationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [StudentsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/student/store', [StudentsController::class, 'store'])->name('students.store');
    Route::post('/student/change_status', [StudentsController::class, 'change_status'])->name('students.change_status');
    Route::get('/student/{id}/edit', [StudentsController::class, 'edit'] );
    Route::post('/student/{id}/update', [StudentsController::class, 'update'])->name('students.update');
    Route::get('/student/{id}/view_student', [StudentsController::class, 'view_student'] );

    // Organization
    Route::get('/organization/{id}/students_details', [OrganizationsController::class, 'students_details'])->name('students.students_details');
    Route::post('/organization/change_status', [OrganizationsController::class, 'change_status'])->name('organization.change_status');
    Route::post('/organization/store', [OrganizationsController::class, 'store'])->name('organization.store');
    Route::post('/organization/{id}/update', [OrganizationsController::class, 'update'])->name('organization.update');

});

Route::get('/organizations_list', [OrganizationsController::class, 'list'] )->middleware(['auth', 'verified'])->name('organization_list');

require __DIR__.'/auth.php';
