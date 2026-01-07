@extends('layouts.app')

@section('header')
<header class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small fw-bold mb-2 d-inline-block">
                <i class="fas fa-chart-line me-1"></i> System Overview
            </span>
            <h2 class="fw-black text-dark mb-0 letter-spacing-tight" style="font-weight: 800; letter-spacing: -1px;">
                Management <span class="text-primary">Console</span>
            </h2>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Current Session</small>
                <span class="fw-bold text-dark">{{ date('l, d M Y') }}</span>
            </div>
            <div class="bg-white p-2 rounded-4 shadow-sm border">
                <i class="far fa-calendar-alt text-primary fs-4 px-1"></i>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')

{{-- ================== NEON STATS SECTION ================== --}}
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-lg rounded-5 h-100 stat-card overflow-hidden" style="background: #ffffff;">
            <div class="card-body p-4 position-relative">
                <div class="visual-blob bg-primary"></div>
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted fw-bold small opacity-75">STUDENTS</h6>
                        <h2 class="display-6 fw-black mb-0">{{ number_format($totalStudents ?? 0) }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-primary shadow-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-lg rounded-5 h-100 stat-card overflow-hidden" style="background: #ffffff;">
            <div class="card-body p-4 position-relative">
                <div class="visual-blob bg-info"></div>
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted fw-bold small opacity-75">COURSES</h6>
                        <h2 class="display-6 fw-black mb-0">{{ $coursesCount ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-info shadow-info">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card border-0 shadow-lg rounded-5 h-100 text-white overflow-hidden" 
             style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="row w-100 align-items-center">
                    <div class="col-sm-7 border-end border-secondary border-opacity-25">
                        <h6 class="small fw-bold opacity-50">TOTAL REVENUE COLLECTED</h6>
                        <h1 class="display-5 fw-black mb-0 text-warning">Rs. {{ number_format($totalFees ?? 0) }}</h1>
                        <p class="mb-0 small opacity-75"><i class="fas fa-arrow-up me-1"></i> 12% increase from last month</p>
                    </div>
                    <div class="col-sm-5 mt-3 mt-sm-0 ps-sm-4">
                        <div class="mb-3">
                            <small class="d-block opacity-50 fw-bold">PENDING</small>
                            <span class="h5 fw-bold">Rs. {{ number_format($pendingFees ?? 0) }}</span>
                        </div>
                        <div class="progress bg-secondary bg-opacity-25" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Add this below the NEON STATS SECTION and above ANALYTICS --}}

<div class="row g-4 mb-5">
    <div class="col-lg-7">
        <div class="card border-0 shadow-lg rounded-5 bg-white overflow-hidden h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-black mb-1">Today's Attendance</h5>
                        <p class="text-muted small mb-0">Live tracking for {{ date('M d, Y') }}</p>
                    </div>
                    @auth
                        @if(auth()->user()->isAdminOrTeacher())
                            <a href="{{ route('attendance.index') }}" class="btn btn-soft-primary btn-sm rounded-pill px-3 fw-bold">Manage Roll Call</a>
                        @else
                            <button class="btn btn-soft-primary btn-sm rounded-pill px-3 fw-bold" disabled title="Only admins and teachers can access Roll Call">Manage Roll Call</button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-soft-primary btn-sm rounded-pill px-3 fw-bold">Manage Roll Call (Login)</a>
                    @endauth
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-center border-end">
                        <div class="position-relative d-inline-block">
                            <svg width="120" height="120" viewBox="0 0 120 120">
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#f1f5f9" stroke-width="12" />
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#4f46e5" stroke-width="12" 
                                    stroke-dasharray="339.29" stroke-dashoffset="{{ 339.29 - (339.29 * (floatval($attendancePercentage ?? 0) / 100)) }}" 
                                    stroke-linecap="round" style="transition: stroke-dashoffset 1s ease-in-out;" />
                            </svg>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <h4 class="fw-black mb-0">{{ $attendancePercentage ?? '0%' }}</h4>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 fw-bold text-dark">Presence Rate</p>
                    </div>
                    <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 bg-success bg-opacity-10 rounded-3 me-3">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block fw-bold">PRESENT</small>
                                <span class="h5 fw-black">{{ $presentStudents ?? 0 }} Students</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-danger bg-opacity-10 rounded-3 me-3">
                                <i class="fas fa-times text-danger"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block fw-bold">ABSENT</small>
                                <span class="h5 fw-black">{{ $absentStudents ?? 0 }} Students</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-lg rounded-5 h-100" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);">
            <div class="card-body p-4 text-white">
                <h5 class="fw-bold mb-4">Staff on Duty</h5>
                <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-white bg-opacity-10 rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-stack me-3">
                            <i class="fas fa-chalkboard-teacher fs-4"></i>
                        </div>
                        <span class="fw-bold">Teachers Present</span>
                    </div>
                    <span class="badge bg-white text-primary rounded-pill">{{ $presentTeachers ?? 0 }} / {{ $totalTeachers ?? 0 }}</span>
                </div>
                <div class="p-3">
                    <p class="small opacity-75 mb-2">Morning Shift Status</p>
                    <div class="d-flex gap-2">
                        <span class="badge rounded-pill bg-success">On Track</span>
                        <span class="badge rounded-pill bg-white bg-opacity-25">{{ $lateStaff ?? 0 }} Late Arrivals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================== ANALYTICS & QUICK ACTIONS ================== --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 bg-white">
            <div class="card-header bg-transparent border-0 p-4 pb-0 d-flex justify-content-between">
                <h5 class="fw-black m-0">System Activity</h5>
                <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold">View Log</button>
            </div>
            <div class="card-body p-4">
                <div class="activity-item d-flex gap-3 mb-4">
                    <div class="activity-dot bg-primary"></div>
                    <div class="border-start ps-4 position-relative">
                        <span class="text-muted small fw-bold">10:30 AM</span>
                        <p class="mb-0 fw-bold">Admission processed for <span class="text-primary">Zain Ahmed</span></p>
                        <small class="text-muted">Managed by Administrator</small>
                    </div>
                </div>
                <div class="activity-item d-flex gap-3 mb-4">
                    <div class="activity-dot bg-warning"></div>
                    <div class="border-start ps-4 position-relative">
                        <span class="text-muted small fw-bold">Yesterday</span>
                        <p class="mb-0 fw-bold">Partial fee received (Rs. 5,000)</p>
                        <small class="text-muted">Transaction ID: #99281</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-lg rounded-5 h-100 overflow-hidden" style="background: #f8fafc;">
            <div class="card-body p-4">
                <h5 class="fw-black mb-4">Quick Control</h5>
                <div class="row g-3">
                    <div class="col-6 text-center">
                        <a href="{{ route('students.create') }}" class="action-btn-modern">
                            <div class="btn-icon bg-soft-primary"><i class="fas fa-plus"></i></div>
                            <span>Student</span>
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('fees.create') }}" class="action-btn-modern">
                            <div class="btn-icon bg-soft-warning"><i class="fas fa-receipt"></i></div>
                            <span>Collect Fee</span>
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="{{ route('courses.create') }}" class="action-btn-modern">
                            <div class="btn-icon bg-soft-info"><i class="fas fa-book-open"></i></div>
                            <span>Course</span>
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" id="quickReportsBtn" class="action-btn-modern" role="button" aria-label="Generate Reports">
                            <div class="btn-icon bg-soft-danger"><i class="fas fa-print"></i></div>
                            <span>Reports</span>
                        </a>
                    </div>
                </div>
                
                <div class="mt-4 p-3 bg-white rounded-4 border">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-shield-alt text-success"></i>
                        <span class="small fw-bold">System Status: <span class="text-success">Optimal</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS STYLING --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f1f5f9;
    }

    .fw-black { font-weight: 800; }

    /* Modern Card Effects */
    .stat-card {
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important;
    }

    /* Visual Blobs */
    .visual-blob {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.1;
        top: -50px;
        right: -50px;
    }

    /* Icon Styling */
    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    .shadow-primary { box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3); }
    .shadow-info { box-shadow: 0 10px 20px rgba(13, 202, 240, 0.3); }

    /* Action Buttons */
    .action-btn-modern {
        text-decoration: none;
        display: block;
        background: white;
        padding: 20px 10px;
        border-radius: 24px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .action-btn-modern:hover {
        background: #000;
        color: white !important;
        transform: scale(1.05);
    }
    .action-btn-modern span {
        font-weight: 700;
        font-size: 0.8rem;
        display: block;
        margin-top: 10px;
        color: #64748b;
    }
    .action-btn-modern:hover span { color: white; }

    .btn-icon {
        width: 45px;
        height: 45px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 1.2rem;
    }
    .bg-soft-primary { background: #eef2ff; color: #4f46e5; }
    .bg-soft-warning { background: #fffbeb; color: #d97706; }
    .bg-soft-info { background: #ecfeff; color: #0891b2; }
    .bg-soft-danger { background: #fef2f2; color: #dc2626; }

    /* Timeline Styling */
    .activity-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-top: 5px;
        z-index: 2;
    }
    .btn-soft-primary {
        background-color: #eef2ff;
        color: #4f46e5;
        border: none;
    }
    .btn-soft-primary:hover {
        background-color: #4f46e5;
        color: white;
    }
    svg circle {
        transform-origin: center;
        transform: rotate(-90deg);
    }
</style>

@push('scripts')
<script>
    async function updateAttendance() {
        try {
            const res = await fetch('/stats/attendance');
            if (!res.ok) throw new Error('Network response was not ok');
            const data = await res.json();
            const elPresent = document.getElementById('presentStudents');
            const elAbsent = document.getElementById('absentStudents');
            const elPercentage = document.getElementById('attendancePercentage');
            const currentPresent = parseInt(elPresent.textContent.replace(/,/g, '')) || 0;
            const currentAbsent = parseInt(elAbsent.textContent.replace(/,/g, '')) || 0;
            const currentPercentage = parseInt(elPercentage.textContent.replace(/[^0-9]/g, '')) || 0;
            // simple numeric update (no elaborate animate helper here)
            elPresent.textContent = data.present;
            elAbsent.textContent = data.absent;
            elPercentage.textContent = data.percentage;
            // update SVG progress circle if present
            const circ = document.querySelector('svg circle[stroke-dashoffset]');
            if (circ) {
                const full = 339.29; // circumference used in SVG calculation
                const offset = full - (full * (data.percentage / 100));
                circ.style.strokeDashoffset = offset;
                const centerText = circ.closest('svg').parentElement.querySelector('h4');
                if (centerText) centerText.textContent = data.percentage + '%';
            }
        } catch (err) {
            console.error('failed to fetch attendance', err);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateAttendance();
        setInterval(updateAttendance, 5000);

        // Quick Reports button: prompt for type and call POST /reports/fees
        const reportBtn = document.getElementById('quickReportsBtn');
        if (reportBtn) {
            reportBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                let type = prompt('Enter report type (pdf or excel)', 'pdf');
                if (!type) return;
                type = type.trim().toLowerCase();
                if (!['pdf', 'excel'].includes(type)) {
                    alert('Invalid report type. Please enter "pdf" or "excel".');
                    return;
                }

                // simple UI feedback
                reportBtn.classList.add('disabled');
                reportBtn.style.opacity = '0.6';

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const res = await fetch('/reports/fees', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ type })
                    });

                    if (!res.ok) throw new Error('Failed to generate report');
                    const data = await res.json();

                    // start download (controller returns a route to download)
                    if (data.file) {
                        window.location = data.file;
                    } else {
                        alert('Report generated but could not find the download link.');
                    }
                } catch (err) {
                    console.error('Report generation failed', err);
                    alert('Could not generate report. See console for details.');
                } finally {
                    reportBtn.classList.remove('disabled');
                    reportBtn.style.opacity = '';
                }
            });
        }
    });
</script>
@endpush
@endsection