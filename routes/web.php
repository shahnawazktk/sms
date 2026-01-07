<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Student;
use App\Models\Teacher;




Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalStudents = Student::count();
    $totalTeachers = Teacher::count();
    return view('dashboard', compact('totalStudents', 'totalTeachers'));
})->middleware(['auth', 'verified'])->name('dashboard');

// JSON endpoint: return current total students (used by welcome page polling)
Route::get('/stats/students', function () {
    return response()->json(['count' => Student::count()]);
});

// JSON endpoint: return current total teachers (used by welcome page polling)
Route::get('/stats/teachers', function () {
    return response()->json(['count' => Teacher::count()]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
