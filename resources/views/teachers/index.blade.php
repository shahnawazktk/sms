@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Teacher Directory</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Teachers</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i> Add New Teacher
    </a>
</div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Teacher Details</th>
                        <th class="py-3">Specialization</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $teacher->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-soft-info text-info me-3 d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px; background: #e0f2fe;">
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $teacher->name }}</h6>
                                    <small class="text-muted">{{ $teacher->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                                <i class="fas fa-book-open me-1 small"></i> {{ $teacher->subject }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-2" style="background: #ecfdf5;">On Duty</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary rounded-2 shadow-sm" title="Edit Teacher">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this teacher?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2 shadow-sm" title="Delete Teacher">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($teachers->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-user-tie fa-3x mb-3 opacity-25"></i>
                                <p>No teachers have been added yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 d-flex justify-content-between align-items-center px-2">
    <p class="text-muted small mb-0">Total Staff Members: <strong>{{ $teachers->count() }}</strong></p>
</div>

@endsection