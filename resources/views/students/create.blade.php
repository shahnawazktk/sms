@extends('layouts.app')

@section('header')
<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1">Add New Student</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
            <li class="breadcrumb-item active">Add Student</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center">
                    <div class="p-2 bg-soft-primary rounded-3 me-3" style="background: #eef2ff;">
                        <i class="fas fa-user-plus text-primary"></i>
                    </div>
                    <h5 class="card-title mb-0 fw-bold">Student Information</h5>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('students.store') }}" method="POST" id="studentForm">
                    @csrf

                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-user text-muted"></i></span>
                                <input type="text" name="name" id="name" 
                                       class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                       placeholder="Enter student's full name" 
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" name="email" id="email" 
                                       class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                       placeholder="example@school.com" 
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label fw-bold small text-uppercase text-muted">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-mobile-alt text-muted"></i></span>
                                <input type="text" name="phone" id="phone" 
                                       class="form-control border-start-0 @error('phone') is-invalid @enderror" 
                                       placeholder="+92 300 1234567" 
                                       value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4 py-2 rounded-3 border">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Student Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-4 p-3 bg-light rounded-4 border-start border-4 border-info">
            <div class="d-flex">
                <i class="fas fa-info-circle text-info mt-1 me-3"></i>
                <p class="small text-muted mb-0">
                    <strong>Tip:</strong> Ensure the email address is unique. A confirmation email will be sent to the student automatically after registration.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Button Loading Animation
    document.getElementById('studentForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        btn.disabled = true;
    });
</script>
@endsection