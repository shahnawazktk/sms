@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Course Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('courses.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
            <i class="fas fa-plus-circle me-2"></i> Add New Course
        </a>
        <button class="btn btn-outline-primary px-4 py-2 rounded-3" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="fas fa-download me-2"></i> Export
        </button>
    </div>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert" style="background: #ecfdf5; color: #065f46;">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Courses</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $courses->total() }}</h2>
                    </div>
                    <div class="avatar-lg rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                        <i class="fas fa-book text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Popular Course</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $mostPopularCourse->title ?? 'N/A' }}</h4>
                        <small class="text-muted">{{ $mostPopularCourse->enrollment_count ?? 0 }} students</small>
                    </div>
                    <div class="avatar-lg rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <i class="fas fa-fire text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Low Enrollment</h6>
                        <h2 class="fw-bold mb-0 text-danger">{{ $lowEnrollmentCount ?? 0 }}</h2>
                        <small class="text-muted">Requires Attention</small>
                    </div>
                    <div class="avatar-lg rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                        <i class="fas fa-exclamation-triangle text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Revenue</h6>
                        <h2 class="fw-bold mb-0 text-dark">${{ number_format($totalRevenue ?? 0, 2) }}</h2>
                        <small class="text-muted">This semester</small>
                    </div>
                    <div class="avatar-lg rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="fas fa-dollar-sign text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0 text-dark">Course Catalog</h5>
            </div>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" id="courseSearch" placeholder="Search courses..." style="width: 200px;">
                <select class="form-select form-select-sm" id="filterStatus" style="width: 150px;">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="coursesTable">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Course Details</th>
                        <th class="py-3">Instructor</th>
                        <th class="py-3">Enrollment</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr class="course-row" data-status="{{ $course->status }}">
                        <td class="ps-4 fw-bold text-muted">#{{ $course->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-3 me-3 d-flex align-items-center justify-content-center fw-bold" 
                                     style="width: 40px; height: 40px; background: #e0f2fe; color: #0ea5e9;">
                                    {{ substr($course->code, 0, 2) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $course->title }}</h6>
                                    <small class="text-muted">{{ $course->code }} | {{ $course->credit_hours }} hrs</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($course->instructor)
                                <span class="fw-medium">{{ $course->instructor->name }}</span>
                            @else
                                <span class="text-muted italic">Unassigned</span>
                            @endif
                        </td>
                        <td>
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-primary" style="width: {{ ($course->current_enrollment / ($course->capacity ?: 1)) * 100 }}%"></div>
                            </div>
                            <small>{{ $course->current_enrollment }} / {{ $course->capacity }}</small>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-light text-success" data-bs-toggle="modal" data-bs-target="#revenueModal" 
                                        data-title="{{ $course->title }}" data-revenue="{{ $course->revenue }}">
                                    <i class="fas fa-chart-line"></i>
                                </button>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Delete course?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5">No courses found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 border-0"><h5 class="fw-bold mb-0">Top Revenue Courses</h5></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Course</th><th>Revenue</th><th>Profit</th></tr></thead>
                        <tbody>
                            @forelse(($topRevenueCourses ?? collect()) as $topCourse)
                            <tr>
                                <td>{{ $topCourse->title }}</td>
                                <td class="fw-bold text-success">${{ number_format($topCourse->revenue, 2) }}</td>
                                <td><span class="badge bg-soft-success text-success">{{ $topCourse->profit_margin }}%</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted">No revenue data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white py-3 border-0"><h5 class="fw-bold mb-0">Distribution</h5></div>
            <div class="card-body">
                <canvas id="revenueChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="revenueModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Revenue Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <h6 id="modalCourseTitle" class="text-muted"></h6>
                <h2 id="modalCourseRevenue" class="fw-bold text-success mt-2"></h2>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Chart.js Implementation (guarded)
    const titles = {!! json_encode(($topRevenueCourses ?? collect())->pluck('title')) !!};
    const revenues = {!! json_encode(($topRevenueCourses ?? collect())->pluck('revenue')) !!};
    const canvas = document.getElementById('revenueChart');
    const ctx = canvas ? canvas.getContext('2d') : null;
    if ((titles || []).length && ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: titles,
                datasets: [{
                    data: revenues,
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                    borderWidth: 0
                }]
            },
            options: { cutout: '70%', plugins: { legend: { position: 'bottom' } } }
        });
    } else if (canvas) {
        canvas.parentNode.innerHTML = '<div class="text-center text-muted py-5">No revenue data</div>';
    }

    // 2. Search Logic
    document.getElementById('courseSearch').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('.course-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });

    // 3. Revenue Modal Logic
    const revModal = document.getElementById('revenueModal');
    revModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('modalCourseTitle').innerText = btn.getAttribute('data-title');
        document.getElementById('modalCourseRevenue').innerText = '$' + parseFloat(btn.getAttribute('data-revenue')).toLocaleString();
    });
});
</script>
@endpush