@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Collect New Fee</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('fees.index') }}" class="text-decoration-none">Fees</a></li>
                <li class="breadcrumb-item active">New Entry</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('fees.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-times me-2"></i> Cancel
    </a>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 text-center">
                <div class="bg-soft-primary p-3 rounded-circle d-inline-flex mb-3" style="background: #eef2ff;">
                    <i class="fas fa-file-invoice-dollar text-primary fs-3"></i>
                </div>
                <h5 class="fw-bold mb-0 text-dark">Finance Record Entry</h5>
                <p class="text-muted small">Please ensure all payment details are correct before saving.</p>
            </div>

            <div class="card-body p-4 pt-2">
                <form method="POST" action="{{ route('fees.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Select Student</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Choose a student...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }} (Roll: {{ $student->roll_number ?? 'N/A' }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('student_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Total Fee Amount (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-bold text-muted">PKR</span>
                                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" 
                                       placeholder="0.00" value="{{ old('amount') }}" required>
                            </div>
                            @error('amount') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Initial Paid Amount (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-bold text-muted">PKR</span>
                                <input type="number" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" 
                                       placeholder="0.00" value="{{ old('paid_amount') }}" required>
                            </div>
                            @error('paid_amount') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Due Date / Payment Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" 
                                       value="{{ old('due_date', date('Y-m-d')) }}" required>
                            </div>
                            @error('due_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm border-0 fw-bold" style="background: #3b82f6;">
                                <i class="fas fa-check-circle me-2"></i> Confirm & Save Transaction
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-muted small">
                <i class="fas fa-shield-alt me-1"></i> This transaction will be logged and reflected in the student's ledger immediately.
            </p>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        border: 1px solid #e2e8f0;
        border-radius: 10px 0 0 10px !important;
    }
    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 0 10px 10px 0 !important;
        padding: 0.6rem 1rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .btn-primary:hover {
        background-color: #2563eb !important;
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
@endsection