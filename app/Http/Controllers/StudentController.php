<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a paginated listing of students.
     */
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        $totalStudents = Student::count();

        return view('students.index', compact('students', 'totalStudents'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }
    /**
 * Display the specified student profile.
 */
public function show(Student $student)
{
    return view('students.show', compact('student'));
}
/**
 * Display the fee ledger of a student.
 */
/**
 * Display the professional fee ledger for a student.
 */
public function ledger(Student $student)
{
    // Load all fees for the student, latest first
    $fees = $student->fees()->orderBy('date', 'asc')->get(); // Ascending by date

    // Calculate total paid and total due
    $totalPaid = $fees->sum('paid_amount');
    $totalDue  = $fees->sum('due_amount');

    // Return view with all necessary data
    return view('students.ledger', compact('student', 'fees', 'totalPaid', 'totalDue'));
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
            'course'        => 'required',
            'gender'        => 'required',
            'address'       => 'required',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'dob', 'course', 'gender', 'address']);

        // Handle profile image if uploaded
        if ($request->hasFile('student_image')) {
            $data['profile_image'] = $request->file('student_image')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')
                         ->with('success', 'Student admission completed successfully!');
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,' . $student->id,
            'phone'         => 'required',
            'dob'           => 'required|date',
            'course'        => 'required',
            'gender'        => 'required',
            'address'       => 'required',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'dob', 'course', 'gender', 'address']);

        // Handle profile image update
        if ($request->hasFile('student_image')) {
            // Delete old image if exists
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }

            $data['profile_image'] = $request->file('student_image')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        // Delete profile image if exists
        if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
            Storage::disk('public')->delete($student->profile_image);
        }

        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully!');
    }
}
