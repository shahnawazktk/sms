<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeeController;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Fee;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;






Route::get('students/{student}/ledger', [StudentController::class, 'ledger'])->name('students.ledger');

Route::get('fees/export', [\App\Http\Controllers\FeeController::class, 'export'])->name('fees.export');
Route::resource('fees', FeeController::class);

Route::resource('courses', CourseController::class);
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalStudents = Student::count();
    $totalTeachers = Teacher::count();
    $coursesCount = Course::count();
    $totalFees = Fee::sum('paid_amount');
    $pendingFees = DB::table('fees')->sum(DB::raw('amount - paid_amount'));

    // Attendance stats for today
    $today = date('Y-m-d');
    $presentStudents = Attendance::where('date', $today)->where('status', 'present')->count();
    $absentStudents = $totalStudents - $presentStudents;
    $attendancePercentage = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;

    return view('dashboard', compact('totalStudents', 'totalTeachers', 'coursesCount', 'totalFees', 'pendingFees', 'presentStudents', 'absentStudents', 'attendancePercentage'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Reports routes (generate and download)
Route::post('/reports/fees', [\App\Http\Controllers\ReportController::class, 'generateFees'])->name('reports.fees')->middleware('auth');
Route::get('/reports/download/{filename}', [\App\Http\Controllers\ReportController::class, 'download'])->name('reports.download')->middleware('auth');

// JSON endpoint: return current total students (used by welcome page polling)
Route::get('/stats/students', function () {
    return response()->json(['count' => Student::count()]);
});

// JSON endpoint: return current total teachers (used by welcome page polling)
Route::get('/stats/teachers', function () {
    return response()->json(['count' => Teacher::count()]);
});

// JSON endpoint: return current total courses (used by dashboard polling)
Route::get('/stats/courses', function () {
    return response()->json(['count' => Course::count()]);
});

// JSON endpoint: return fee totals (collected and pending)
Route::get('/stats/fees', function () {
    return response()->json([
        'totalFees' => Fee::sum('paid_amount'),
        'pendingFees' => DB::table('fees')->sum(DB::raw('amount - paid_amount')),
    ]);
});

// JSON endpoint: return attendance stats for today
Route::get('/stats/attendance', function () {
    $today = date('Y-m-d');
    $totalStudents = Student::count();
    $present = Attendance::where('date', $today)->where('status', 'present')->count();
    $absent = $totalStudents - $present;
    $percentage = $totalStudents > 0 ? round(($present / $totalStudents) * 100) : 0;
    return response()->json(['present' => $present, 'absent' => $absent, 'percentage' => $percentage]);
});

// Roll Call UI and API
use App\Http\Controllers\AttendanceController;
Route::get('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export')->middleware('auth');
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('auth');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store')->middleware('auth');
Route::post('/attendance/bulk', [AttendanceController::class, 'bulk'])->name('attendance.bulk')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
