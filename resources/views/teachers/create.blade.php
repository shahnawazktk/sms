@extends('layouts.app')

@section('header')
<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1">Register New Teacher</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}" class="text-decoration-none">Teachers</a></li>
            <li class="breadcrumb-item active">Add Teacher</li>
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
                    <div class="p-2 bg-soft-info rounded-3 me-3" style="background: #e0f2fe;">
                        <i class="fas fa-user-plus text-info"></i>
                    </div>
                    <h5 class="card-title mb-0 fw-bold">Teacher Enrollment Form</h5>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('teachers.store') }}" method="POST" id="teacherForm">
                    @csrf

                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-user text-muted"></i></span>
                                <input type="text" name="name" id="name" 
                                       class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                       placeholder="Enter teacher's full name" 
                                       value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback text-start">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" name="email" id="email" 
                                       class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                       placeholder="teacher@school.com" 
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback text-start">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="subject" class="form-label fw-bold small text-uppercase text-muted">Subject / Department</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-book-open text-muted"></i></span>
                                <input type="text" name="subject" id="subject" 
                                       class="form-control border-start-0 @error('subject') is-invalid @enderror" 
                                       placeholder="e.g. Computer Science" 
                                       value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback text-start">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('teachers.index') }}" class="btn btn-light px-4 py-2 rounded-3 border">Cancel</a>
                        <button type="submit" class="btn btn-info px-4 py-2 rounded-3 shadow-sm text-white fw-bold">
                            <i class="fas fa-save me-2"></i> Save Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple spinner on submit
    document.getElementById('teacherForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving Record...';
        btn.classList.add('disabled');
    });
</script>
@endsection