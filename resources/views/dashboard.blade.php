@extends('layouts.app')

@section('header')
    <header class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Analytics Overview</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="text-muted small fw-bold text-uppercase">
                <i class="far fa-calendar-alt me-1"></i> {{ date('F d, Y') }}
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75 small fw-bold text-uppercase">Total Students</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($totalStudents ?? 0) }}</h3>
                    </div>
                    <i class="fas fa-user-graduate fs-1 opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-white p-3 h-100" style="background: #6610f2;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75 small fw-bold text-uppercase">Active Teachers</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($totalTeachers ?? 0) }}</h3>
                    </div>
                    <i class="fas fa-chalkboard-teacher fs-1 opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-info text-white p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75 small fw-bold text-uppercase">Active Courses</h6>
                        <h3 class="fw-bold mb-0" id="coursesCount">{{ number_format($coursesCount ?? 0) }}</h3>
                    </div>
                    <i class="fas fa-book-open fs-1 opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-success text-white p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="opacity-75 small fw-bold text-uppercase">Fees Collected</h6>
                        <h3 class="fw-bold mb-0">Rs. <span id="totalFees">{{ number_format($totalFees ?? 0) }}</span></h3>
                    </div>
                    <i class="fas fa-hand-holding-usd fs-1 opacity-25"></i>
                </div>
                <div class="mt-2 pt-2 border-top border-white border-opacity-10">
                    <span class="small opacity-75 fw-bold">
                        <i class="fas fa-clock me-1"></i> Pending: Rs. <span id="pendingFees">{{ number_format($pendingFees ?? 0) }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h5 class="fw-bold text-dark mb-3">Quick Actions</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('students.create') }}" class="btn btn-white border shadow-sm rounded-3 px-3">
                    <i class="fas fa-plus-circle text-primary me-2"></i>New Student
                </a>
                <a href="{{ route('teachers.create') }}" class="btn btn-white border shadow-sm rounded-3 px-3">
                    <i class="fas fa-plus-circle text-info me-2"></i>New Teacher
                </a>
                <a href="{{ route('courses.create') }}" class="btn btn-white border shadow-sm rounded-3 px-3">
                    <i class="fas fa-plus-circle text-info me-2"></i>New Course
                </a>
                <a href="{{ route('fees.create') }}" class="btn btn-white border shadow-sm rounded-3 px-3">
                    <i class="fas fa-plus-circle text-info me-2"></i>New Fee Record
                </a>
                <div class="dropdown">
                    <button class="btn btn-white border shadow-sm rounded-3 px-3 dropdown-toggle" type="button" id="reportsMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-print text-muted me-2"></i>Generate Reports
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="reportsMenu">
                        <li><a class="dropdown-item" href="#" onclick="generateReport('pdf')">Download PDF</a></li>
                        <li><a class="dropdown-item" href="#" onclick="generateReport('excel')">Download Excel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // small counter animator for dashboard cards
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        if (!obj) return;
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
            if (progress < 1) { window.requestAnimationFrame(step); }
        };
        window.requestAnimationFrame(step);
    }

    async function updateCoursesCount() {
        try {
            const res = await fetch('/stats/courses');
            if (!res.ok) throw new Error('Network response was not ok');
            const data = await res.json();
            const el = document.getElementById('coursesCount');
            const current = parseInt(el.textContent.replace(/,/g, '')) || 0;
            animateValue('coursesCount', current, data.count, 800);
        } catch (err) {
            console.error('failed to fetch courses count', err);
        }
    }

    // poll every 5 seconds while dashboard is open
    async function updateFeesStats() {
        try {
            const res = await fetch('/stats/fees');
            if (!res.ok) throw new Error('Network response was not ok');
            const data = await res.json();
            const elTotal = document.getElementById('totalFees');
            const elPending = document.getElementById('pendingFees');
            const currentTotal = parseInt(elTotal.textContent.replace(/,/g, '')) || 0;
            const currentPending = parseInt(elPending.textContent.replace(/,/g, '')) || 0;
            animateValue('totalFees', currentTotal, data.totalFees, 800);
            animateValue('pendingFees', currentPending, data.pendingFees, 800);
        } catch (err) {
            console.error('failed to fetch fees stats', err);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateCoursesCount();
        setInterval(updateCoursesCount, 5000);
        updateFeesStats();
        setInterval(updateFeesStats, 5000);
    });

    async function generateReport(type) {
        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const btnText = type === 'pdf' ? 'PDF' : 'Excel';
            const res = await fetch('{{ route('reports.fees') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ type })
            });
            if (!res.ok) throw new Error('Server error');
            const data = await res.json();
            // Trigger download
            window.location = data.file;
        } catch (err) {
            console.error('Failed to generate report', err);
            alert('Failed to generate report. Check console for details.');
        }
    }
</script>
@endpush