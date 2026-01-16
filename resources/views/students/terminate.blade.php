@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-user-slash me-2"></i> Student Termination
                    </h5>
                    <a href="{{ route('students.index') }}" class="btn btn-light btn-sm rounded-3">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                </div>

                <div class="card-body">

                    {{-- Student Info Summary --}}
                    <div class="alert alert-light border mb-4">
                        <h6 class="fw-bold mb-2">Student Information</h6>
                        <div class="row">
                            <div class="col-md-6"><strong>Name:</strong> {{ $student->name }}</div>
                            <div class="col-md-6"><strong>Course:</strong> {{ $student->course }}</div>
                            <div class="col-md-6"><strong>Email:</strong> {{ $student->email }}</div>
                            <div class="col-md-6"><strong>Phone:</strong> {{ $student->phone }}</div>
                        </div>
                    </div>

                    {{-- Warning --}}
                    <div class="alert alert-warning d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle me-3 mt-1"></i>
                        <div>
                            <strong>Warning:</strong>  
                            Terminating this student will deactivate the profile.  
                            Fee records and ledger will remain safe and recoverable.
                        </div>
                    </div>

                    {{-- Termination Form --}}
                    <form action="{{ route('students.terminate', $student->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Termination Date</label>
                            <input type="date" name="termination_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Reason for Termination</label>
                            <select name="reason" class="form-select" required>
                                <option value="">Select Reason</option>
                                <option value="Course Completed">Course Completed</option>
                                <option value="Dropout">Dropout</option>
                                <option value="Disciplinary Action">Disciplinary Action</option>
                                <option value="Fee Issues">Fee Issues</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Additional Remarks (Optional)</label>
                            <textarea name="remarks" class="form-control" rows="3"
                                placeholder="Any additional notes..."></textarea>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">
                                I confirm that I want to terminate this student.
                            </label>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-user-slash me-2"></i> Terminate Student
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
