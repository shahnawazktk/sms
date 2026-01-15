@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="p-5 bg-primary position-relative" style="height: 160px; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
                    <div class="position-absolute top-100 start-50 translate-middle">
                        <div class="bg-white p-1 rounded-circle shadow">
                             @if($student->profile_image)
                                    <img src="{{ asset('storage/' . $student->profile_image) }}" 
                                        class="rounded-circle object-fit-cover" 
                                        width="130" height="130" 
                                        alt="Avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&size=130&background=f3f4f6&color=4f46e5" 
                                        class="rounded-circle" alt="Avatar">
                                @endif
                        </div>
                    </div>
                </div>

                <div class="card-body pt-5 mt-5 text-center">
                    <h3 class="fw-bold text-dark mb-1">{{ $student->name }}</h3>
                    <p class="text-muted mb-3"><i class="fas fa-id-badge me-2"></i>Student ID: #{{ date('Y') }}-0{{ $student->id }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-soft-success text-success px-3 py-2 rounded-pill fw-bold">Active Student</span>
                        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill fw-bold">{{ $student->course }}</span>
                    </div>

                    <hr class="mx-5 opacity-25">

                    <div class="row text-start px-md-5 py-4 g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light-subtle">
                                <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Email Address</label>
                                <span class="fw-semibold text-dark">{{ $student->email }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light-subtle">
                                <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                <span class="fw-semibold text-dark">{{ $student->phone }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light-subtle">
                                <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Date of Birth</label>
                                <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($student->dob)->format('d M, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light-subtle">
                                <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Gender</label>
                                <span class="fw-semibold text-dark">{{ $student->gender }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 border rounded-3 bg-light-subtle">
                                <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Residential Address</label>
                                <span class="fw-semibold text-dark">{{ $student->address }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 pb-5 d-flex justify-content-center gap-3">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4 py-2 rounded-pill border fw-bold text-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning px-4 py-2 rounded-pill shadow-sm fw-bold">
                            <i class="fas fa-edit me-2"></i> Edit Profile
                        </a>
                        <button onclick="window.print()" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm fw-bold">
                            <i class="fas fa-print me-2"></i> Print ID Card
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-success { background-color: #d1fae5; }
    .bg-soft-primary { background-color: #dbeafe; }
    .x-small { font-size: 10px; letter-spacing: 0.5px; }
    .object-fit-cover { object-fit: cover; }
    
    @media print {
        .btn, .breadcrumb, nav { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>
<style>
    .bg-soft-success { background-color: #d1fae5 !important; -webkit-print-color-adjust: exact; }
    .bg-soft-primary { background-color: #dbeafe !important; -webkit-print-color-adjust: exact; }
    .bg-primary { -webkit-print-color-adjust: exact; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%) !important; }
    .x-small { font-size: 10px; letter-spacing: 0.5px; }
    .object-fit-cover { object-fit: cover; }
    
    @media print {
        /* Browser ke default margins aur header/footer khatam karein */
        @page {
            margin: 0;
            size: auto;
        }
        
        body {
            margin: 1cm; /* Page ke charon taraf thori si jagah */
            background-color: #fff !important;
        }

        /* Buttons aur फालतू cheezein hide karein */
        .btn, .breadcrumb, nav, footer, .card-footer { 
            display: none !important; 
        }

        /* Card ko single page par fit karne ke liye */
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #eee !important;
            page-break-inside: avoid; /* Card ko tootne se bachaye */
        }

        /* Background colors ko force karein takay print mein colors aayein */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Spacing kam karein takay data upar chala jaye */
        .py-5 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
        .p-5 { padding: 2rem !important; }
        .mt-5 { margin-top: 2rem !important; }
    }
</style>
@endsection