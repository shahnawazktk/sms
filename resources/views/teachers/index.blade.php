@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Faculty Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Teachers</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary px-3 py-2 rounded-3 shadow-sm border-0" style="background: #f0f9ff;">
            <i class="fas fa-calendar-alt me-2"></i> Timetable
        </button>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
            <i class="fas fa-plus me-2"></i> Add New Teacher
        </a>
    </div>
</div>
@endsection

@section('content')

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3" style="background: #eff6ff; color: #3b82f6;">
                    <i class="fas fa-user-chalkboard fa-lg"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $teachers->count() }}</h4>
                    <p class="text-muted small mb-0">Total Faculty Members</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3" style="background: #f0fdf4; color: #22c55e;">
                    <i class="fas fa-check-double fa-lg"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">98%</h4>
                    <p class="text-muted small mb-0">Attendance Rate</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3" style="background: #fefce8; color: #ca8a04;">
                    <i class="fas fa-star fa-lg"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">4.8/5.0</h4>
                    <p class="text-muted small mb-0">Avg. Student Feedback</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body py-3">
        <div class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                    <input type="text" id="teacherSearch" class="form-control border-start-0" placeholder="Search by name or subject expertise...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="departmentFilter">
                    <option value="">All Specializations</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Business Admin">Business Admin</option>
                    <option value="Graphic Design">Graphic Design</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="teacherTable">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Faculty Details</th>
                        <th class="py-3">Specialization</th>
                        <th class="py-3">Workload</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr class="teacher-row">
                        <td class="ps-4 fw-bold text-muted">#{{ $teacher->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-3 me-3 d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" 
                                     style="width: 45px; height: 45px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $teacher->name }}</h6>
                                    <small class="text-muted"><i class="far fa-envelope me-1"></i>{{ $teacher->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                                <i class="fas fa-brain me-1 small text-primary"></i> {{ $teacher->subject }}
                            </span>
                        </td>
                        <td>
                            <div style="width: 120px;">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="x-small fw-bold">Active Courses</small>
                                    <small class="x-small">3/5</small>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2" style="background: #ecfdf5; color: #059669; font-size: 11px;">
                                <i class="fas fa-circle me-1" style="font-size: 7px;"></i> ON DUTY
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-light text-warning" title="View Performance"><i class="fas fa-chart-line"></i></button>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Archive teacher record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.x-small { font-size: 10px; }
.teacher-row:hover { background-color: #f8fafc; transition: 0.3s ease; }
.avatar-sm { font-size: 1.2rem; }
</style>

@endsection

@push('scripts')
<script>
    // Real-time Faculty Search
    document.getElementById('teacherSearch').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        document.querySelectorAll('.teacher-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endpush