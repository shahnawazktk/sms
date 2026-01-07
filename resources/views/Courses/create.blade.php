@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Create New Course</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Courses</a></li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-arrow-left me-2"></i> Back to List
    </a>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="fas fa-book-medical text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Course Information</h5>
                        <p class="text-muted small mb-0">Please fill in all the details to register a new course.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Course Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-muted"></i></span>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       placeholder="e.g. Advanced Web Development" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Course Code</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-barcode text-muted"></i></span>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" 
                                       placeholder="e.g. CS-101" value="{{ old('code') }}" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Credit Hours</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-clock text-muted"></i></span>
                                <input type="number" name="credit_hours" class="form-control @error('credit_hours') is-invalid @enderror" 
                                       placeholder="e.g. 3" value="{{ old('credit_hours') }}" required min="1">
                                @error('credit_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-5 text-end">
                            <hr class="text-light mb-4">
                            <button type="reset" class="btn btn-light px-4 py-2 me-2 rounded-3 text-muted">Reset</button>
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
                                <i class="fas fa-save me-2"></i> Save Course Details
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for a professional form feel */
    .input-group-text {
        border: 1px solid #e2e8f0;
        border-radius: 10px 0 0 10px !important;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 0 10px 10px 0 !important;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .btn-primary:hover {
        background-color: #2563eb !important;
        transform: translateY(-1px);
    }
</style>
@endsection