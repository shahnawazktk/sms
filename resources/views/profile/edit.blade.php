@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Account Settings</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-semibold text-primary">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-white text-dark shadow-sm border px-3 py-2 rounded-3">
                <i class="far fa-calendar-alt me-2 text-primary"></i> {{ date('F d, Y') }}
            </span>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid px-0">
    <div class="row g-4">
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden mb-4">
                <div class="position-absolute top-0 start-0 w-100" style="height: 100px; background: linear-gradient(45deg, #3b82f6, #60a5fa);"></div>
                
                <div class="card-body pt-5 pb-4 text-center">
                    <div class="position-relative d-inline-block mb-3 mt-3">
                        <div class="avatar-xxl rounded-circle border border-4 border-white shadow-sm d-flex align-items-center justify-content-center bg-white text-primary fw-bold" 
                             style="width: 110px; height: 110px; font-size: 3rem; position: relative; z-index: 1;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-2" title="Online" style="z-index: 2;"></span>
                    </div>
                    
                    <h4 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-3 small"><i class="fas fa-envelope me-1"></i> {{ Auth::user()->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge rounded-pill bg-soft-primary text-primary px-3">Admin Access</span>
                        <span class="badge rounded-pill bg-soft-success text-success px-3">Active</span>
                    </div>

                    <div class="row g-0 border-top pt-4">
                        <div class="col-6 border-end">
                            <h6 class="fw-bold mb-0 small">Member Since</h6>
                            <p class="text-muted small mb-0">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-6">
                            <h6 class="fw-bold mb-0 small">Last Update</h6>
                            <p class="text-muted small mb-0">{{ Auth::user()->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="col-xl-8 col-lg-7">
            <ul class="nav nav-pills mb-4 gap-2 p-1 bg-white rounded-4 shadow-sm d-inline-flex" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-3" id="basic-info-tab" data-bs-toggle="pill" data-bs-target="#basic-info" type="button">
                        <i class="fas fa-user-edit me-2"></i>Personal Info
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button">
                        <i class="fas fa-lock me-2"></i>Security
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0">Public Profile</h5>
                            <p class="text-muted small">Update your account's profile information and email address.</p>
                        </div>
                        <div class="card-body p-4 pt-0">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0">Update Password</h5>
                            <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="card-body p-4 pt-0">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card border-0 border-start border-danger border-4 shadow-sm rounded-4">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold text-danger mb-1">Delete Account</h6>
                                <p class="text-muted small mb-0">Once deleted, all data will be permanently removed.</p>
                            </div>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling for Professional Look */
    .bg-soft-primary { background-color: rgba(59, 130, 246, 0.1) !important; }
    .bg-soft-success { background-color: rgba(16, 185, 129, 0.1) !important; }
    
    .nav-pills .nav-link {
        color: #64748b;
        font-weight: 500;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        background-color: #3b82f6 !important;
        color: #fff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .card {
        border: 1px solid rgba(0,0,0,0.03) !important;
    }

    /* Adjusting the partial forms inner styles */
    .max-w-xl { max-width: 100% !important; }
</style>
@endsection