@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1 text-capitalize">Edit Course: {{ $course->code }}</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Courses</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-arrow-left me-2"></i> Cancel & Back
    </a>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="fas fa-edit text-warning fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Update Course Details</h5>
                        <p class="text-muted small mb-0">Modify the fields below to update the course records.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('courses.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Course Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-muted"></i></span>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $course->title) }}" required placeholder="Enter course title">
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
                                       value="{{ old('code', $course->code) }}" required placeholder="CS-101">
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
                                       value="{{ old('credit_hours', $course->credit_hours) }}" required min="1">
                                @error('credit_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-5 text-end">
                            <hr class="text-light mb-4">
                            <a href="{{ route('courses.index') }}" class="btn btn-light px-4 py-2 me-2 rounded-3 text-muted">Discard Changes</a>
                            <button type="submit" class="btn btn-warning px-5 py-2 rounded-3 shadow-sm border-0 fw-bold">
                                <i class="fas fa-sync-alt me-2"></i> Update Course
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-4 p-3 bg-soft-info rounded-4 border-0 d-flex align-items-center" style="background: #e0f2fe;">
            <i class="fas fa-info-circle text-info me-3 fs-4"></i>
            <p class="small text-dark mb-0">
                Updating the course code may affect existing student enrollments linked to this code.
            </p>
        </div>
    </div>
</div>

<style>
    /* Styling to match your professional theme */
    .input-group-text {
        border: 1px solid #e2e8f0;
        border-radius: 10px 0 0 10px !important;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 0 10px 10px 0 !important;
        padding: 0.65rem 1rem;
    }
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .btn-warning {
        background: #f59e0b;
        color: white;
    }
    .btn-warning:hover {
        background: #d97706;
        color: white;
        transform: translateY(-1px);
    }
</style>
@endsection