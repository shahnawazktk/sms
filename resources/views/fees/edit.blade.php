@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Fee Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item active fw-bold text-primary">Fees Ledger</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-light border px-3 rounded-3 shadow-sm text-muted">
            <i class="fas fa-file-download me-2"></i>Export
        </button>
        <a href="{{ route('fees.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
            <i class="fas fa-plus-circle me-2"></i> Record New Fee
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="bg-soft-primary p-3 rounded-3 me-3" style="background: #eef2ff; color: #3b82f6;">
                    <i class="fas fa-money-bill-wave fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Expected Revenue</small>
                    <h4 class="fw-bold mb-0">Rs. {{ number_format($fees->sum('amount')) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="bg-soft-success p-3 rounded-3 me-3" style="background: #ecfdf5; color: #10b981;">
                    <i class="fas fa-check-double fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Total Collected</small>
                    <h4 class="fw-bold mb-0 text-success">Rs. {{ number_format($fees->sum('paid_amount')) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="bg-soft-danger p-3 rounded-3 me-3" style="background: #fef2f2; color: #ef4444;">
                    <i class="fas fa-exclamation-circle fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Outstanding Balance</small>
                    <h4 class="fw-bold mb-0 text-danger">Rs. {{ number_format($fees->sum('remaining')) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">Student Name</th>
                        <th class="py-3 text-end">Total Fee</th>
                        <th class="py-3 text-end">Paid</th>
                        <th class="py-3 text-end">Remaining</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-soft-primary d-flex align-items-center justify-content-center me-3" 
                                     style="width: 35px; height: 35px; background: #f8fafc; color: #64748b; font-size: 0.8rem; font-weight: bold;">
                                    {{ substr($fee->student->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $fee->student->name }}</h6>
                                    <small class="text-muted small">ID: #{{ $fee->student->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-end fw-semibold">Rs. {{ number_format($fee->amount) }}</td>
                        <td class="text-end text-success fw-semibold">Rs. {{ number_format($fee->paid_amount) }}</td>
                        <td class="text-end text-danger fw-semibold">Rs. {{ number_format($fee->remaining) }}</td>
                        <td class="text-center">
                            @php
                                $status_badge = [
                                    'paid' => ['bg' => '#ecfdf5', 'text' => '#059669', 'label' => 'Fully Paid'],
                                    'partial' => ['bg' => '#fffbeb', 'text' => '#d97706', 'label' => 'Partial'],
                                    'unpaid' => ['bg' => '#fef2f2', 'text' => '#dc2626', 'label' => 'Unpaid'],
                                ][$fee->status] ?? ['bg' => '#f8fafc', 'text' => '#64748b', 'label' => ucfirst($fee->status)];
                            @endphp
                            <span class="badge px-3 py-2 rounded-pill fw-medium" 
                                  style="background: {{ $status_badge['bg'] }}; color: {{ $status_badge['text'] }}; font-size: 0.75rem;">
                                <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> {{ $status_badge['label'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm rounded-2 overflow-hidden">
                                <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-white btn-sm border-end" title="Edit Record">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-white btn-sm" title="Delete Record">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-receipt fa-3x mb-3 opacity-25"></i>
                            <p>No fee records found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $fees->links('pagination::bootstrap-5') }}
</div>

<style>
    .bg-white { background-color: #ffffff !important; }
    .table thead th { border-bottom: none; }
    .table tbody tr { transition: all 0.2s; }
    .table tbody tr:hover { background-color: #fcfcfd; }
    .btn-white { background: #fff; border: 1px solid #edf2f7; }
    .btn-white:hover { background: #f8fafc; }
</style>
@endsection