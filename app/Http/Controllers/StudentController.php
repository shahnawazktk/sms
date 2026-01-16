<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a paginated listing of students (with status filter).
     */
    public function index(Request $request)
    {
        $status = $request->get('status');

        $students = Student::when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        $totalStudents = Student::count();

        return view('students.index', compact('students', 'totalStudents', 'status'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email',
            'phone'         => 'required',
            'dob'           => 'required|date',
            'course_id'     => 'required|exists:courses,id',
            'gender'        => 'required',
            'address'       => 'required',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only([
            'name','email','phone','dob',
            'course_id','gender','address'
        ]);

        if ($request->hasFile('student_image')) {
            $data['profile_image'] =
                $request->file('student_image')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student admission completed successfully!');
    }

    /**
     * Display the specified student profile.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Display the professional fee ledger for a student.
     */
    public function ledger(Student $student)
    {
        $fees = $student->fees()->orderBy('date', 'asc')->get();

        $totalPaid = $fees->sum('paid_amount');
        $totalDue  = $fees->sum('due_amount');

        return view('students.ledger', compact(
            'student', 'fees', 'totalPaid', 'totalDue'
        ));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,' . $student->id,
            'phone'         => 'required',
            'dob'           => 'required|date',
            'course_id'     => 'required|exists:courses,id',
            'gender'        => 'required',
            'address'       => 'required',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only([
            'name','email','phone','dob',
            'course_id','gender','address'
        ]);

        if ($request->hasFile('student_image')) {
            if ($student->profile_image &&
                Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }

            $data['profile_image'] =
                $request->file('student_image')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Soft delete student (basic delete).
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student removed successfully!');
    }

    /**
     * Terminate (Blacklist) the student with reason & date.
     */
    public function terminate(Request $request, Student $student)
    {
        if ($student->trashed()) {
            return back()->with('error', 'Student is already terminated.');
        }

        $request->validate([
            'termination_date'   => 'required|date',
            'reason'             => 'required|string|max:255',
            'remarks'            => 'nullable|string',
        ]);

        // Use MODEL business logic
        $student->terminate(
            $request->reason,
            $request->remarks,
            $request->termination_date
        );

        return redirect()->route('students.index')
            ->with('success', 'Student terminated successfully.');
    }

    /**
     * Restore terminated student.
     */
    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restoreStudent();

        return redirect()->route('students.index')
            ->with('success', 'Student restored successfully.');
    }
}
