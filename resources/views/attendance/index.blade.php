@extends('layouts.app')

@section('header')
<header class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small fw-bold mb-2 d-inline-block">
                <i class="fas fa-robot me-1"></i> AI-Powered Attendance Hub
            </span>
            <h2 class="fw-black text-dark mb-0 letter-spacing-tight" style="font-weight: 800; letter-spacing: -1px;">
                Roll <span class="text-primary">Call</span>
            </h2>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <div id="syncIndicator" class="text-muted small fw-bold d-none d-md-flex align-items-center me-3">
                <div class="spinner-grow spinner-grow-sm text-success me-2" role="status"></div>
                Cloud Sync Active
            </div>

            <div class="d-flex align-items-center gap-2 bg-white p-2 rounded-4 shadow-sm border">
                <form id="dateForm" class="d-flex align-items-center" method="get" action="{{ route('attendance.index') }}">
                    <i class="far fa-calendar-alt text-muted ms-2 me-2"></i>
                    <input type="date" id="attendanceDate" name="date" value="{{ $date }}" class="form-control form-control-sm border-0 fw-bold" style="box-shadow: none;" />
                    <button class="btn btn-sm btn-primary rounded-3 px-3 ms-2">Go</button>
                </form>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <small class="text-muted fw-bold d-block mb-1">PRESENT RATE</small>
            <div class="d-flex align-items-end gap-2">
                <h3 class="fw-black mb-0">85%</h3>
                <span class="text-success small fw-bold mb-1"><i class="fas fa-caret-up"></i> 2%</span>
            </div>
            <div class="progress mt-2" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 85%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <small class="text-muted fw-bold d-block mb-1">TOTAL ABSENTEES</small>
            <div class="d-flex align-items-end gap-2">
                <h3 class="fw-black mb-0 text-danger" id="totalAbsentCount">04</h3>
                <span class="text-muted small mb-1">Students</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-2 bg-white h-100 d-flex flex-row align-items-center px-3">
            <i class="fas fa-search text-muted me-3"></i>
            <input type="text" id="studentSearch" class="form-control border-0 shadow-none fw-bold" placeholder="Search student by name or ID (Alt + F)">
            <select class="form-select border-0 shadow-none fw-bold w-auto" id="filterStatus">
                <option value="all">All Status</option>
                <option value="present">Only Present</option>
                <option value="absent">Only Absent</option>
            </select>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg rounded-5 overflow-hidden bg-white">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="fw-bold text-dark">
                <i class="fas fa-list-ul me-2 text-primary"></i> 
                Student Ledger <span class="badge bg-light text-primary border ms-2" id="selectedCounter">0 Selected</span>
            </div>
            <div class="d-flex gap-2">
                <button id="markAllPresent" class="btn btn-soft-success btn-sm rounded-pill px-3 fw-bold">
                    <i class="fas fa-check me-1"></i> Present All
                </button>
                <button id="bulkSaveBtn" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold shadow-primary">
                    <i class="fas fa-save me-1"></i> Sync Data (S)
                </button>
            </div>
        </div>

        <div class="table-responsive rounded-4 border">
            <table class="table table-hover align-middle mb-0" id="attendanceTable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" width="50"><input class="form-check-input" type="checkbox" id="selectAll"></th>
                        <th class="text-uppercase small fw-black text-muted">Identity</th>
                        <th class="text-uppercase small fw-black text-muted text-center">Marking Area</th>
                        <th class="text-uppercase small fw-black text-muted d-none d-md-table-cell text-center">Attendance Health</th>
                        <th class="text-uppercase small fw-black text-muted text-end pe-4">History</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="student-row" data-name="{{ strtolower($student->name) }}">
                            <td class="ps-4">
                                <input class="form-check-input select-student" type="checkbox" data-student-id="{{ $student->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=random" class="rounded-circle me-3" width="38">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $student->name }}</h6>
                                        <span class="x-small text-muted fw-bold">ID: #{{ $student->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <div class="status-pills d-flex bg-light p-1 rounded-pill border">
                                        <button class="btn btn-pill-sm status-btn present {{ (isset($attendances[$student->id]) && $attendances[$student->id]['status'] == 'present') ? 'active' : '' }}" data-status="present">P</button>
                                        <button class="btn btn-pill-sm status-btn absent {{ (isset($attendances[$student->id]) && $attendances[$student->id]['status'] == 'absent') ? 'active' : '' }}" data-status="absent">A</button>
                                        <button class="btn btn-pill-sm status-btn leave {{ (isset($attendances[$student->id]) && $attendances[$student->id]['status'] == 'leave') ? 'active' : '' }}" data-status="leave">L</button>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell text-center">
                                <div class="progress rounded-pill mx-auto" style="height: 5px; width: 80px;">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                                <small class="x-small text-muted">90% this month</small>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-link btn-sm text-muted p-0"><i class="fas fa-history"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Premium UX Styles */
    .x-small { font-size: 10px; }
    .fw-black { font-weight: 800; }
    
    .status-btn {
        width: 32px; height: 32px; border-radius: 50%; border: none;
        background: transparent; color: #64748b; font-weight: 800;
        font-size: 12px; transition: 0.2s;
    }
    .status-btn.present.active { background: #16a34a; color: white; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.3); }
    .status-btn.absent.active { background: #dc2626; color: white; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3); }
    .status-btn.leave.active { background: #d97706; color: white; box-shadow: 0 4px 10px rgba(217, 119, 6, 0.3); }
    
    .btn-soft-success { background: #dcfce7; color: #16a34a; }
    .student-row:hover { background-color: #f8fafc; }
    
    /* Keyboard Shortcut Hint Tooltip style */
    .shortcut-hint { position: fixed; bottom: 20px; right: 20px; background: #1e293b; color: white; padding: 10px 20px; border-radius: 12px; display: none; }
</style>

@endsection

@push('scripts')
<script>
    // 1. Advanced Feature: Real-time Search
    document.getElementById('studentSearch').addEventListener('keyup', function() {
        let query = this.value.toLowerCase();
        document.querySelectorAll('.student-row').forEach(row => {
            let name = row.getAttribute('data-name');
            row.style.display = name.includes(query) ? '' : 'none';
        });
    });

    // 2. Advanced Feature: Keyboard Shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.altKey && e.key === 'f') { // Alt + F to focus search
            e.preventDefault();
            document.getElementById('studentSearch').focus();
        }
        if (e.key === 's' || e.key === 'S') { // S to Save
            if (document.activeElement.tagName !== 'INPUT') {
                e.preventDefault();
                document.getElementById('bulkSaveBtn').click();
            }
        }
    });

    // 3. Status Button Toggle Logic
    document.querySelectorAll('.status-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const parent = this.parentElement;
            parent.querySelectorAll('.status-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show Sync Indicator (Simulating real-time data push)
            const sync = document.getElementById('syncIndicator');
            sync.classList.remove('d-none');
            setTimeout(() => sync.classList.add('d-none'), 1500);
        });
    });
</script>
@endpush