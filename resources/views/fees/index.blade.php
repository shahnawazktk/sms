@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Financial Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item active fw-semibold text-primary">Accounts Ledger</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-light border px-4 py-2 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#reportModal">
            <i class="fas fa-chart-pie me-2"></i> Monthly Report
        </button>
        <a href="{{ route('fees.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
            <i class="fas fa-plus-circle me-2"></i> Record Transaction
        </a>
    </div>
</div>
@endsection

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-success border-4">
            <div class="d-flex align-items-center">
                <div class="bg-soft-success p-3 rounded-3 me-3" style="background: #ecfdf5; color: #10b981;">
                    <i class="fas fa-user-graduate fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 10px;">Fees Collected</small>
                    <h4 class="fw-bold mb-0 text-dark">PKR {{ number_format($fees->sum('paid_amount')) }}</h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-danger border-4">
            <div class="d-flex align-items-center">
                <div class="bg-soft-danger p-3 rounded-3 me-3" style="background: #fef2f2; color: #ef4444;">
                    <i class="fas fa-chalkboard-teacher fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 10px;">Salaries Paid</small>
                    <h4 class="fw-bold mb-0 text-dark">PKR {{ number_format($totalSalaries ?? 0) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 p-3 rounded-3 me-3 text-white">
                    <i class="fas fa-coins fa-lg"></i>
                </div>
                <div>
                    <small class="text-white-50 d-block fw-bold text-uppercase" style="font-size: 10px;">Net Cash Flow</small>
                    <h4 class="fw-bold mb-0">PKR {{ number_format($fees->sum('paid_amount') - ($totalSalaries ?? 0)) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-pills mb-4 gap-2 px-2" id="financeTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active rounded-pill px-4 shadow-sm" id="student-tab" data-bs-toggle="pill" data-bs-target="#studentFees">Student Fees</button>
    </li>
    <li class="nav-item">
        <button class="nav-link rounded-pill px-4 shadow-sm" id="teacher-tab" data-bs-toggle="pill" data-bs-target="#teacherSalaries">Teacher Salaries</button>
    </li>
</ul>

<div class="tab-content" id="financeTabsContent">
    <div class="tab-pane fade show active" id="studentFees">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-0">
                <h5 class="fw-bold mb-0 text-dark">Fee Transactions</h5>
                <input type="text" class="form-control form-control-sm w-25" id="feeSearch" placeholder="Search Student...">
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Student</th>
                            <th>Total Fee</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fees as $fee)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $fee->student->name }}</div>
                                <small class="text-muted">ID: #{{ $fee->id }} | {{ $fee->created_at->format('d M, Y') }}</small>
                            </td>
                            <td>PKR {{ number_format($fee->amount) }}</td>
                            <td class="text-success fw-bold">PKR {{ number_format($fee->paid_amount) }}</td>
                            <td class="text-danger">PKR {{ number_format($fee->remaining) }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 {{ $fee->status == 'paid' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning' }}" 
                                      style="background: {{ $fee->status == 'paid' ? '#ecfdf5' : '#fffbeb' }}">
                                    {{ ucfirst($fee->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light text-dark me-1" title="Download Receipt"><i class="fas fa-file-invoice-dollar"></i></button>
                                <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="teacherSalaries">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 px-4 border-0">
                <h5 class="fw-bold mb-0 text-dark">Payroll Management</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Faculty Member</th>
                            <th>Base Salary</th>
                            <th>Allowances</th>
                            <th>Total Payable</th>
                            <th>Payment Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers ?? [] as $teacher)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $teacher->name }}</div>
                                <small class="text-muted">{{ $teacher->subject }}</small>
                            </td>
                            <td>PKR 45,000</td>
                            <td class="text-info">+5,000</td>
                            <td class="fw-bold">PKR 50,000</td>
                            <td><span class="badge bg-success rounded-pill px-3 py-2">Transferred</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3">View Slip</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">No salary records for this month.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link { color: #64748b; background: white; border: 1px solid #e2e8f0; font-weight: 500; }
    .nav-pills .nav-link.active { background: #3b82f6 !important; color: white !important; }
    .bg-soft-success { color: #059669 !important; }
    .bg-soft-warning { color: #d97706 !important; }
    .bg-soft-danger { color: #dc2626 !important; }
</style>

@endsection