@extends('layouts.app')

@section('header')
<header class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small fw-bold mb-2 d-inline-block">
                <i class="fas fa-calendar-check me-1"></i> Attendance Management
            </span>
            <h2 class="fw-black text-dark mb-0 letter-spacing-tight" style="font-weight: 800; letter-spacing: -1px;">
                Roll <span class="text-primary">Call</span>
            </h2>
        </div>
        <div class="d-flex align-items-center gap-2 bg-white p-2 rounded-4 shadow-sm border">
            <form id="dateForm" class="d-flex align-items-center" method="get" action="{{ route('attendance.index') }}">
                <i class="far fa-calendar-alt text-muted ms-2 me-2"></i>
                <input type="date" id="attendanceDate" name="date" value="{{ $date }}" class="form-control form-control-sm border-0 fw-bold" style="box-shadow: none;" />
                <button class="btn btn-sm btn-primary rounded-3 px-3 ms-2">Go</button>
            </form>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="card border-0 shadow-lg rounded-5 overflow-hidden bg-white">
    <div class="card-body p-4">
        <div class="row align-items-center mb-4 g-3">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-soft-primary p-3 rounded-4">
                        <i class="fas fa-users text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold mb-0">STUDENTS LIST</h6>
                        <span class="fw-black text-dark h5 mb-0" id="selectedCountDisplay">0 Selected</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-md-end">
                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                    <div class="btn-group rounded-pill overflow-hidden border">
                        <button id="markAllPresent" class="btn btn-white btn-sm fw-bold border-end"><i class="fas fa-check text-success me-1"></i> All Present</button>
                        <button id="markAllAbsent" class="btn btn-white btn-sm fw-bold border-end"><i class="fas fa-times text-danger me-1"></i> All Absent</button>
                        <button id="markAllLeave" class="btn btn-white btn-sm fw-bold"><i class="fas fa-envelope text-secondary me-1"></i> All Leave</button>
                    </div>
                    
                    <button id="openQuickMark" class="btn btn-dark btn-sm rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#quickMarkModal">
                        <i class="fas fa-bolt me-1 text-warning"></i> Quick Mark
                    </button>
                    
                    <button id="bulkSaveBtn" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold shadow-primary">
                        <i class="fas fa-save me-1"></i> Save Changes (S)
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive rounded-4 border">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" width="50">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th class="text-uppercase small fw-black text-muted">Student Info</th>
                        <th class="text-uppercase small fw-black text-muted text-center">Status Control</th>
                        <th class="text-uppercase small fw-black text-muted d-none d-md-table-cell">Marked By</th>
                        <th class="text-uppercase small fw-black text-muted text-end pe-4">Last Updated</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($students as $student)
                        @php $a = $attendances[$student->id] ?? null; @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="form-check">
                                    <input class="form-check-input select-student" type="checkbox" data-student-id="{{ $student->id }}">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 bg-soft-primary text-primary fw-bold">
                                        {{ substr($student->name ?? 'S', 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $student->name ?? '-' }}</h6>
                                        <small class="text-muted fw-bold">{{ $student->class_name ?? 'Class N/A' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <select data-student-id="{{ $student->id }}" class="form-select form-select-sm attendance-select rounded-pill px-3 fw-bold border-2" 
                                        style="width: 140px; {{ (isset($a['status']) && $a['status'] === 'absent') ? 'border-color: #fee2e2; color: #dc2626;' : ((isset($a['status']) && $a['status'] === 'present') ? 'border-color: #dcfce7; color: #16a34a;' : '') }}">
                                        <option value="present" {{ (isset($a['status']) && $a['status'] === 'present') ? 'selected' : '' }}>🟢 Present</option>
                                        <option value="absent" {{ (isset($a['status']) && $a['status'] === 'absent') ? 'selected' : '' }}>🔴 Absent</option>
                                        <option value="leave" {{ (isset($a['status']) && $a['status'] === 'leave') ? 'selected' : '' }}>🟡 Leave</option>
                                    </select>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span class="badge bg-light text-dark rounded-pill px-3">
                                    <i class="far fa-user me-1 small"></i> 
                                    @if(isset($a['marked_by'])) {{ \App\Models\User::find($a['marked_by'])->name ?? 'System' }} @else — @endif
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <small class="text-muted fw-bold">{{ $a['updated_at'] ?? 'Never' }}</small>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div class="small text-muted fw-bold">
                <i class="fas fa-keyboard me-2"></i> <span class="badge bg-light text-dark">P</span> Present | <span class="badge bg-light text-dark">A</span> Absent | <span class="badge bg-light text-dark">L</span> Leave
            </div>
            <div id="saveStatus" class="badge bg-success rounded-pill px-4 py-2" style="display:none; transition: all 0.3s ease;">
                <i class="fas fa-check-circle me-1"></i> Data Synchronized
            </div>
        </div>
    </div>
</div>

{{-- Quick Mark Modal (Updated Styling) --}}
<div class="modal fade" id="quickMarkModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="modal-body p-5 text-center">
                <div class="bg-soft-warning p-4 rounded-circle d-inline-block mb-4">
                    <i class="fas fa-bolt text-warning fs-1"></i>
                </div>
                <h4 class="fw-black mb-1">Quick Attendance</h4>
                <p class="text-muted mb-4">Set status for <span id="selectedCount" class="fw-bold text-dark">0</span> selected students.</p>
                
                <select id="quickMarkStatus" class="form-select form-select-lg rounded-4 border-2 mb-4 fw-bold">
                    <option value="present">Mark as Present</option>
                    <option value="absent">Mark as Absent</option>
                    <option value="leave">Mark as Leave</option>
                </select>

                <div class="d-grid gap-2">
                    <button type="button" id="applyQuickMark" class="btn btn-primary btn-lg rounded-4 fw-bold shadow-primary">Apply to Selected</button>
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    .fw-black { font-weight: 800; }
    .bg-soft-primary { background: #eef2ff; color: #4f46e5; }
    .bg-soft-warning { background: #fffbeb; color: #d97706; }
    .shadow-primary { box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); }
    
    .avatar-circle {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
    }

    .table thead th { border: none; padding-top: 15px; padding-bottom: 15px; }
    .table tbody td { border-bottom: 1px solid #f1f5f9; padding-top: 15px; padding-bottom: 15px; }
    
    .attendance-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    .btn-white { background: white; border: 1px solid #e2e8f0; color: #64748b; }
    .btn-white:hover { background: #f8fafc; color: #1e293b; }

    .form-check-input:checked { background-color: #4f46e5; border-color: #4f46e5; }
</style>
@endsection