@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Manage Courses</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Courses</a></li>
                <li class="breadcrumb-item active">Add New Course</li>
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
    <div class="col-lg-10"> <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fas fa-book-open text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Course Registration</h5>
                        <p class="text-muted small mb-0">Define course parameters, fees, and duration for the academic year.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('courses.store') }}" method="POST" id="courseForm">
                    @csrf

                    <h6 class="text-primary mb-3 fw-bold small text-uppercase">Basic Details</h6>
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-muted small text-uppercase">Course Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-muted"></i></span>
                                <input type="text" name="title" class="form-control border-start-0 @error('title') is-invalid @enderror" 
                                       placeholder="e.g. Graphic Designing or Mathematics Class 10" value="{{ old('title') }}" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Course Code</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-barcode text-muted"></i></span>
                                <input type="text" name="code" class="form-control border-start-0 @error('code') is-invalid @enderror" 
                                       placeholder="e.g. CS-101" value="{{ old('code') }}" required>
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-12"><hr class="opacity-25"></div>
                        <h6 class="text-primary mb-1 fw-bold small text-uppercase">Pricing & Duration</h6>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Admission Fee (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                <input type="number" name="fee" class="form-control border-start-0 @error('fee') is-invalid @enderror" 
                                       placeholder="5000" value="{{ old('fee') }}" required>
                                @error('fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Duration</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-day text-muted"></i></span>
                                <select name="duration" class="form-select border-start-0 @error('duration') is-invalid @enderror" required>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="1 Year">1 Year (Academic)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Credit Hours</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-clock text-muted"></i></span>
                                <input type="number" name="credit_hours" class="form-control border-start-0 @error('credit_hours') is-invalid @enderror" 
                                       placeholder="e.g. 3" value="{{ old('credit_hours') }}" required min="1">
                                @error('credit_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">Course Description</label>
                            <textarea name="description" class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      rows="3" placeholder="Briefly explain what this course covers...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="reset" class="btn btn-light px-4 py-2 me-2 rounded-3 text-muted border">Clear Form</button>
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
                                <i class="fas fa-save me-2"></i> Register Course
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Professional styling to match the student form */
    .input-group-text {
        border: 1px solid #e2e8f0;
        border-radius: 10px 0 0 10px !important;
    }
    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 0 10px 10px 0 !important;
        padding: 0.6rem 1rem;
    }
    textarea.form-control {
        border-radius: 10px !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .btn-primary:hover {
        background-color: #2563eb !important;
        transform: translateY(-1px);
        transition: all 0.2s;
    }
</style>

<script>
    document.getElementById('courseForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        btn.disabled = true;
    });
</script>
@endsection