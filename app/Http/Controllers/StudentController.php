<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
{
    $students = Student::all();
    $totalStudents = Student::count();  // 🔹 total students
    return view('students.index', compact('students', 'totalStudents'));
}

    // public function index()
    // {
    //     $students = Student::all();
    //     return view('students.index', compact('students'));
    // }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Store student
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Student added successfully');
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully');
    }
}
