@extends('layouts.app')

@section('header')
<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1">Edit Student Record</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none text-muted">Students</a></li>
            <li class="breadcrumb-item active fw-semibold text-dark">Edit Student</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid #e5e7eb !important;">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center">
                    <div class="p-2 rounded-3 me-3" style="background: #fffbeb;">
                        <i class="fas fa-user-edit text-warning"></i>
                    </div>
                    <h5 class="card-title mb-0 fw-bold text-dark">Update Information for: <span class="text-primary">{{ $student->name }}</span></h5>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('students.update', $student->id) }}" method="POST" id="editStudentForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3" style="color: #374151;">Personal Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-user text-secondary"></i></span>
                                        <input type="text" name="name" class="form-control border-secondary-subtle border-start-0 @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Date of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-calendar-alt text-secondary"></i></span>
                                        <input type="date" name="dob" class="form-control border-secondary-subtle border-start-0" value="{{ old('dob', $student->dob) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="far fa-envelope text-secondary"></i></span>
                                        <input type="email" name="email" class="form-control border-secondary-subtle border-start-0" value="{{ old('email', $student->email) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-mobile-alt text-secondary"></i></span>
                                        <input type="text" name="phone" class="form-control border-secondary-subtle border-start-0" value="{{ old('phone', $student->phone) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 border-start border-secondary-subtle d-flex flex-column align-items-center justify-content-center">
                            <h6 class="fw-bold mb-3 text-uppercase text-secondary small">Profile Photo</h6>
                            <div class="mb-3 position-relative">
                                <div id="image-preview-container" class="rounded-4 overflow-hidden border border-secondary-subtle shadow-sm" style="width: 150px; height: 150px; background: #f9fafb;">
                                    <img id="image-preview" 
                                         src="{{ $student->profile_image ? asset($student->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($student->name).'&background=f3f4f6&color=4b5563&size=200' }}" 
                                         class="img-fluid w-100 h-100 object-fit-cover" 
                                         alt="Preview">
                                </div>
                            </div>
                            <label for="student_image" class="btn btn-outline-dark btn-sm px-3 rounded-pill shadow-sm">
                                <i class="fas fa-camera me-1"></i> Change Photo
                            </label>
                            <input type="file" name="student_image" id="student_image" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <hr class="my-4 border-secondary opacity-25">
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary">Course / Class</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-book text-secondary"></i></span>
                                <select name="course" class="form-select border-secondary-subtle border-start-0 text-dark" required>
                                    <option value="Computer Science" {{ $student->course == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                    <option value="Pre-Medical" {{ $student->course == 'Pre-Medical' ? 'selected' : '' }}>Pre-Medical</option>
                                    <option value="Pre-Engineering" {{ $student->course == 'Pre-Engineering' ? 'selected' : '' }}>Pre-Engineering</option>
                                    <option value="Commerce" {{ $student->course == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary d-block">Gender</label>
                            <div class="d-flex mt-2 gap-4">
                                <div class="form-check">
                                    <input class="form-check-input border-secondary" type="radio" name="gender" id="male" value="Male" {{ $student->gender == 'Male' ? 'checked' : '' }} required>
                                    <label class="form-check-label text-dark fw-medium" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input border-secondary" type="radio" name="gender" id="female" value="Female" {{ $student->gender == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label text-dark fw-medium" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-bold small text-uppercase text-secondary">Residential Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-secondary-subtle border-end-0"><i class="fas fa-map-marker-alt text-secondary"></i></span>
                                <textarea name="address" class="form-control border-secondary-subtle border-start-0" rows="2" required>{{ old('address', $student->address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4 py-2 rounded-3 border fw-semibold text-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning px-4 py-2 rounded-3 shadow-sm fw-bold text-dark">
                            <i class="fas fa-sync-alt me-2"></i> Update Records
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-3 rounded-4 border border-danger border-opacity-10" style="background: #fff5f5;">
            <div class="d-flex">
                <i class="fas fa-info-circle text-danger mt-1 me-3"></i>
                <div>
                    <h6 class="mb-0 fw-bold text-danger small">Important Notice</h6>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Changes to identity details might affect generated reports and student cards.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
    .form-control:focus, .form-select:focus {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
    }
</style>

<script>
    // Preview Image when selected
    document.getElementById('student_image').onchange = evt => {
        const [file] = document.getElementById('student_image').files;
        if (file) {
            document.getElementById('image-preview').src = URL.createObjectURL(file);
        }
    }

    // Loading Animation
    document.getElementById('editStudentForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving Changes...';
        btn.disabled = true;
    });
</script>
@endsection