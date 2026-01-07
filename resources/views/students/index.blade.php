@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Student Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Students</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
        <i class="fas fa-plus me-2"></i> Add New Student
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
                <thead class="bg-light text-muted uppercase">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th class="py-3">Student Info</th>
                        <th class="py-3">Phone</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $student->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-soft-primary text-primary me-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: #eef2ff;">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $student->name }}</h6>
                                    <small class="text-muted">{{ $student->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary small">
                                <i class="fas fa-phone-alt me-1 opacity-50"></i> {{ $student->phone }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-2" style="background: #ecfdf5;">Active</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary rounded-2 shadow-sm" title="Edit Student">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2 shadow-sm" title="Delete Student">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($students->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/gray/data-report.svg" alt="No Data" style="height: 120px;" class="mb-3">
                            <p class="text-muted">No students found in the records.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<p class="text-muted mt-3 small ps-2">Showing {{ $students->count() }} total registered students</p>

@endsection