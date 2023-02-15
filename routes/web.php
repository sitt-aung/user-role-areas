<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:' . \App\Enums\RoleEnum::STUDENT->value)
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [Student\TimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:' . \App\Enums\RoleEnum::TEACHER->value)
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            Route::get('timetable', [Teacher\TimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:' . \App\Enums\RoleEnum::ADMIN->value)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('users', [Admin\UserController::class, 'index'])
                ->name('users');
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
