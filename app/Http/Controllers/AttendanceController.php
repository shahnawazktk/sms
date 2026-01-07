<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Only allow admins and teachers to manage roll call
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (!$user || !in_array($user->role, ['admin', 'teacher', 'staff'])) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $date = $request->query('date', now()->toDateString());
        // Order by the single `name` column (students table uses `name` not first/last names)
        $students = Student::orderBy('name')->get();

        // Get attendances keyed by student id including status, marked_by and updated_at
        $attendances = Attendance::where('date', $date)->get()->keyBy('student_id')->map(function ($a) {
            return [
                'status' => $a->status,
                'marked_by' => $a->marked_by,
                'updated_at' => $a->updated_at ? $a->updated_at->toDateTimeString() : null,
            ];
        })->toArray();

        return view('attendance.index', compact('students', 'attendances', 'date'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => ['required', Rule::in(['present', 'absent', 'leave'])],
        ]);

        $attendance = Attendance::updateOrCreate(
            ['student_id' => $data['student_id'], 'date' => $data['date']],
            ['status' => $data['status'], 'marked_by' => auth()->id()]
        );

        return response()->json(['success' => true, 'attendance' => $attendance]);
    }

    public function bulk(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'statuses' => 'required|array',
            'statuses.*.student_id' => 'required|exists:students,id',
            'statuses.*.status' => ['required', Rule::in(['present', 'absent', 'leave'])],
        ]);

        foreach ($data['statuses'] as $s) {
            Attendance::updateOrCreate(
                ['student_id' => $s['student_id'], 'date' => $data['date']],
                ['status' => $s['status'], 'marked_by' => auth()->id()]
            );
        }

        return response()->json(['success' => true]);
    }

    /**
     * Export attendance for a date as CSV.
     */
    public function export(Request $request)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'type' => 'nullable|in:csv,pdf,excel',
        ]);

        $type = $data['type'] ?? 'csv';

        // Determine date range
        if (!empty($data['from']) && !empty($data['to'])) {
            $from = $data['from'];
            $to = $data['to'];
            $query = Attendance::whereBetween('date', [$from, $to]);
            $filenameDate = "{$from}_to_{$to}";
        } elseif (!empty($data['date'])) {
            $from = $to = $data['date'];
            $query = Attendance::where('date', $from);
            $filenameDate = $from;
        } else {
            $from = $to = now()->toDateString();
            $query = Attendance::where('date', $from);
            $filenameDate = $from;
        }

        $rows = $query->with(['student', 'markedBy'])->get()->map(function ($a) {
            return [
                'student_id' => $a->student_id,
                // students table stores a single `name` field; prefer that
                'student_name' => $a->student->name ?? ($a->student->full_name ?? ''),
                'status' => $a->status,
                'marked_by' => optional($a->markedBy)->name,
                'updated_at' => $a->updated_at ? $a->updated_at->toDateTimeString() : null,
            ];
        });

        $filename = "attendance_{$filenameDate}";

        if ($type === 'excel') {
            $filename .= '.xlsx';
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AttendanceExport($rows), $filename);
        }

        if ($type === 'pdf') {
            $filename .= '.pdf';
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.attendance', ['records' => $rows, 'from' => $from, 'to' => $to]);
            return $pdf->download($filename);
        }

        // Default CSV
        $filename .= '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];

        $fh = fopen('php://temp', 'r+');
        fputcsv($fh, ['student_id', 'student_name', 'status', 'marked_by', 'updated_at']);
        foreach ($rows as $row) {
            fputcsv($fh, [$row['student_id'], $row['student_name'], $row['status'], $row['marked_by'], $row['updated_at']]);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return response($csv, 200, $headers);
    }
}
