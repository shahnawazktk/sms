<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the application
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Student;
use App\Models\Attendance;

$students = Student::all();
if ($students->isEmpty()) {
    echo "No students found. Nothing to seed.\n";
    exit(0);
}

$cnt = 0;
foreach ($students as $s) {
    Attendance::updateOrCreate([
        'student_id' => $s->id,
        'date' => date('Y-m-d'),
    ], [
        'status' => 'present',
    ]);
    $cnt++;
}

echo "Seeded attendance for {$cnt} students for date " . date('Y-m-d') . "\n";