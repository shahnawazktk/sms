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
    <a href="{{ route('courses.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
        <i class="fas fa-plus-circle me-2"></i> Add New Course
    </a>
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

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom-0">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">Course Catalog</h5>
            <div class="text-muted small">Total Registered: <span class="fw-bold text-primary">{{ $courses->total() }}</span></div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Course Details</th>
                        <th class="py-3">Course Code</th>
                        <th class="py-3">Credit Hours</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $course->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-3 bg-soft-info text-info me-3 d-flex align-items-center justify-content-center fw-bold" 
                                     style="width: 40px; height: 40px; background: #e0f2fe; color: #0ea5e9;">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $course->title }}</h6>
                                    <small class="text-muted text-capitalize">Academic Program</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill fw-medium px-3 py-2" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                                <i class="fas fa-hashtag me-1 small opacity-50"></i>{{ $course->code }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-dark me-1">{{ $course->credit_hours }}</span>
                                <span class="text-muted small">Hours</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-light rounded-2 text-primary" title="Edit Course">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light rounded-2 text-danger" title="Delete Course">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="py-4">
                                <i class="fas fa-folder-open display-1 text-light mb-3"></i>
                                <h5 class="text-muted">No courses found</h5>
                                <p class="small text-muted">Start by adding a new course to the system.</p>
                                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">Add First Course</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-4 px-2">
    <div class="text-muted small">
        Showing <strong>{{ $courses->firstItem() ?? 0 }}</strong> to <strong>{{ $courses->lastItem() ?? 0 }}</strong> of <strong>{{ $courses->total() }}</strong> records
    </div>
    <div>
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    /* Professional Table Styling */
    .table thead th {
        font-weight: 600;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #f1f5f9;
    }
    .table tbody tr {
        transition: all 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    .btn-light {
        background: #f1f5f9;
        border: none;
    }
    .btn-light:hover {
        background: #e2e8f0;
    }
    /* Pagination Overrides */
    .pagination { gap: 5px; }
    .page-link { border-radius: 8px !important; border: none; background: #f1f5f9; color: #475569; }
    .page-item.active .page-link { background: #3b82f6; color: white; }
</style>
@endsection