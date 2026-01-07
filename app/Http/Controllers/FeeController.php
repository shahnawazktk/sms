<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->latest()->paginate(10);
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id'  => 'required|exists:students,id',
        'amount'      => 'required|numeric|min:0',
        'paid_amount' => 'nullable|numeric|min:0',
        'due_date'    => 'required|date', // Isko add karein
    ]);

    $paid = $request->paid_amount ?? 0;
    
    // Status Logic
    $status = 'unpaid';
    if ($paid >= $request->amount) {
        $status = 'paid';
    } elseif ($paid > 0) {
        $status = 'partial';
    }

    Fee::create([
        'student_id'  => $request->student_id,
        'amount'      => $request->amount,
        'paid_amount' => $paid,
        'status'      => $status,
        'due_date'    => $request->due_date,
    ]);

    return redirect()->route('fees.index')->with('success', 'Fee added successfully');
}

    public function edit(Fee $fee)
    {
        $students = Student::orderBy('name')->get();
        // Provide the fees collection used by the dashboard cards and table in the edit view
        $fees = Fee::with('student')->latest()->paginate(10);
        return view('fees.edit', compact('fee', 'students', 'fees'));
    }

    public function update(Request $request, Fee $fee)
    {
        $paid = $request->paid_amount;
        $status = $paid == 0 ? 'unpaid' : ($paid < $request->amount ? 'partial' : 'paid');

        $fee->update([
            'student_id' => $request->student_id,
            'amount' => $request->amount,
            'paid_amount' => $paid,
            'status' => $status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('fees.index')->with('success', 'Fee updated successfully');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee deleted');
    }
}
