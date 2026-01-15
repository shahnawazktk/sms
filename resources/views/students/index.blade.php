@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="background: #f4f7fe; min-height: 100vh;">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h3 class="fw-black text-dark mb-1" style="letter-spacing: -1px;">Student Command Center</h3>
            <p class="text-muted small mb-0">
                <i class="fas fa-chart-line me-1 text-primary"></i> Academic Year 2025-26 • Session: Autumn
            </p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white shadow-sm border-0 px-3 rounded-3 text-primary fw-bold">
                <i class="fas fa-cloud-download-alt me-2"></i> Report
            </button>
            <a href="{{ route('students.create') }}" class="btn btn-primary shadow-lg border-0 px-4 py-2 rounded-3 fw-bold">
                <i class="fas fa-plus-circle me-2"></i> Enroll Student
            </a>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-muted x-small fw-bold text-uppercase ls-1">Retention Rate</span>
                        <h3 class="fw-bold mb-0 mt-1">98.2%</h3>
                        <span class="text-success x-small fw-bold"><i class="fas fa-arrow-up"></i> 2.1%</span>
                    </div>
                    <div class="icon-shape bg-soft-primary text-primary rounded-3 px-3 py-2">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-muted x-small fw-bold text-uppercase ls-1">At Risk Students</span>
                        <h3 class="fw-bold mb-0 mt-1">12</h3>
                        <span class="text-danger x-small fw-bold"><i class="fas fa-exclamation-triangle"></i> Needs Attention</span>
                    </div>
                    <div class="icon-shape bg-soft-danger text-danger rounded-3 px-3 py-2">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 text-center">
                <span class="text-muted x-small fw-bold text-uppercase">Financial Standing</span>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h4 class="mb-0 fw-bold">75% Collected</h4>
                </div>
                <div class="progress mt-2" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Students Table --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        {{-- Table Header --}}
        <div class="card-header bg-white py-4 px-4 border-0">
            <div class="row align-items-center g-3">
                <div class="col-md-4">
                    <div class="search-box position-relative">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" class="form-control ps-5 border-light bg-light rounded-pill py-2" placeholder="ID, Name, or Phone...">
                    </div>
                </div>
                <div class="col-md-8 text-md-end">
                    <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                        <button class="btn btn-white active border-0 px-4">All</button>
                        <button class="btn btn-white border-0 px-4">Active</button>
                        <button class="btn btn-white border-0 px-4">Graduated</button>
                        <button class="btn btn-white border-0 px-4">Blacklist</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Body --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light-gray">
                    <tr class="text-uppercase x-small fw-black text-muted letter-spacing-1">
                        <th class="ps-4">Student Identity</th>
                        <th>Learning Path</th>
                        <th>Academic Progress</th>
                        <th>Fee Status</th>
                        <th>Engagement</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="hover-row shadow-sm-hover">
                        {{-- Student Identity --}}
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    @php
                                        $profileImage = $student->profile_image
                                            ? asset('storage/' . $student->profile_image)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=6366f1&color=fff';
                                    @endphp
                                    <img src="{{ $profileImage }}" 
                                         class="rounded-circle shadow-sm object-fit-cover" 
                                         width="48" height="48"
                                         alt="{{ $student->name }}"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=6366f1&color=fff'">
                                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-0 fs-6">{{ $student->name }}</div>
                                    <span class="text-muted x-small">REG: {{ date('Y') }}-0{{ $student->id }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Course --}}
                        <td>
                            <div class="badge bg-soft-info text-info border-0 px-3 py-2 rounded-pill fw-bold">
                                {{ $student->course ?? 'Full Stack Dev' }}
                            </div>
                        </td>

                        {{-- Academic Progress --}}
                        <td>
                            <div style="min-width: 140px;">
                                <div class="d-flex justify-content-between x-small fw-bold mb-1">
                                    <span>Rank: #14</span>
                                    <span>84%</span>
                                </div>
                                <div class="progress rounded-pill shadow-none" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 84%"></div>
                                </div>
                            </div>
                        </td>

                        {{-- Fee Status --}}
                        <td>
                            <span class="text-{{ rand(0,1) ? 'success' : 'danger' }} fw-bold small">
                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                {{ rand(0,1) ? 'Cleared' : 'Pending PKR 4,500' }}
                            </span>
                        </td>

                        {{-- Engagement --}}
                        <td>
                            <div class="avatar-group d-flex">
                                <span class="badge bg-light text-dark fw-normal rounded-pill px-3">
                                    <i class="fas fa-calendar-check me-2 text-primary"></i> 90% Presence
                                </span>
                            </div>
                        </td>

                        {{-- Manage --}}
                        <td class="text-center pe-4">
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                                    <li><a class="dropdown-item py-2" href="{{ route('students.show', $student->id) }}"><i class="fas fa-id-badge me-2 text-primary"></i> Profile Card</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('students.ledger', $student->id) }}"><i class="fas fa-file-invoice me-2 text-warning"></i> View Ledger</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fas fa-user-minus me-2"></i> Terminate</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .fw-black { font-weight: 800; }
    .x-small { font-size: 11px; }
    .ls-1 { letter-spacing: 1px; }
    .bg-soft-primary { background: #e0e7ff; }
    .bg-soft-danger { background: #fee2e2; }
    .bg-soft-info { background: #e0f2fe; }
    .hover-row { transition: 0.3s; border-bottom: 1px solid #f1f5f9; }
    .hover-row:hover { background-color: #ffffff !important; transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
    .icon-shape { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .btn-white { background: #fff; color: #475569; }
    .btn-white.active { background: #3b82f6; color: #fff; }
    .table-responsive::-webkit-scrollbar { height: 6px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
@endsection
