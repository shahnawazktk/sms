@extends('layouts.app')

@section('header')
<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1">Student Admission</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none text-muted">Students</a></li>
            <li class="breadcrumb-item active fw-semibold text-dark">New Admission</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <form action="{{ route('students.store') }}" method="POST" id="studentForm" enctype="multipart/form-data">
            @csrf
            
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid #e5e7eb !important;">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <div class="p-2 rounded-3 me-3" style="background: #f3f4f6;">
                            <i class="fas fa-user-graduate text-dark"></i>
                        </div>
                        <h5 class="card-title mb-0 fw-bold text-dark">Admission Form</h5>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3" style="color: #374151;">Personal Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-user text-secondary"></i></span>
                                        <input type="text" name="name" class="form-control border-secondary-subtle border-start-0 text-dark @error('name') is-invalid @enderror" placeholder="Student's name" value="{{ old('name') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Date of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-calendar-alt text-secondary"></i></span>
                                        <input type="date" name="dob" class="form-control border-secondary-subtle border-start-0 text-dark" value="{{ old('dob') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-envelope text-secondary"></i></span>
                                        <input type="email" name="email" class="form-control border-secondary-subtle border-start-0 text-dark" placeholder="student@example.com" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-mobile-alt text-secondary"></i></span>
                                        <input type="text" name="phone" class="form-control border-secondary-subtle border-start-0 text-dark" placeholder="+92 3XX XXXXXXX" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 border-start border-secondary-subtle d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold mb-3 text-uppercase text-secondary small">Student Photo</h6>
                            <div class="mb-3 position-relative">
                                <div id="image-preview-container" class="rounded-4 overflow-hidden border border-secondary-subtle shadow-sm" style="width: 160px; height: 180px; background: #f9fafb;">
                                    <img id="image-preview" src="https://ui-avatars.com/api/?name=S&background=f3f4f6&color=4b5563&size=200" class="img-fluid w-100 h-100 object-fit-cover" alt="Preview">
                                </div>
                            </div>
                            <label for="student_image" class="btn btn-outline-secondary btn-sm px-3 rounded-pill shadow-sm">
                                <i class="fas fa-camera me-1"></i> Upload Photo
                            </label>
                            <input type="file" name="student_image" id="student_image" class="d-none" accept="image/*">
                            <p class="text-muted smallest mt-2 px-3 text-center" style="font-size: 0.7rem;">Allowed: JPG, PNG. Max: 2MB</p>
                        </div>
                    </div>

                    <hr class="my-4 border-secondary opacity-25">
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary">Course / Class</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-book text-secondary"></i></span>
                                <select name="course" class="form-select border-secondary-subtle border-start-0 text-dark" required>
                                    <option value="" selected disabled>Choose a course...</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Pre-Medical">Pre-Medical</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary d-block">Gender</label>
                            <div class="d-flex mt-2 gap-4">
                                <div class="form-check">
                                    <input class="form-check-input border-secondary" type="radio" name="gender" value="Male" required>
                                    <label class="form-check-label text-dark fw-medium">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-secondary" type="radio" name="gender" value="Female">
                                    <label class="form-check-label text-dark fw-medium">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary">Residential Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-map-marker-alt text-secondary"></i></span>
                                <textarea name="address" class="form-control border-secondary-subtle border-start-0 text-dark" rows="2" placeholder="Complete address..." required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4 py-2 rounded-3 border fw-semibold text-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark px-4 py-2 rounded-3 shadow-sm fw-semibold">
                            <i class="fas fa-check-circle me-2"></i> Submit Admission
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .form-control::placeholder { color: #9ca3af !important; }
    .form-control:focus, .form-select:focus {
        border-color: #4b5563 !important;
        box-shadow: 0 0 0 3px rgba(75, 85, 99, 0.1) !important;
    }
    .input-group-text { color: #4b5563 !important; }
    .object-fit-cover { object-fit: cover; }
</style>

<script>
    // Image Preview Script
    document.getElementById('student_image').onchange = evt => {
        const [file] = document.getElementById('student_image').files;
        if (file) {
            document.getElementById('image-preview').src = URL.createObjectURL(file);
        }
    }

    // Button Loading
    document.getElementById('studentForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving Data...';
        btn.disabled = true;
    });
</script>
@endsection