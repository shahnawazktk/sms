@extends('layouts.app')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Fee Management</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item active fw-semibold text-primary">Fee Ledger</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('fees.export') }}" class="btn btn-light border px-4 py-2 rounded-3 shadow-sm">
    <i class="fas fa-file-export me-2"></i> Export
</a>
        <a href="{{ route('fees.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm border-0" style="background: #3b82f6;">
            <i class="fas fa-plus-circle me-2"></i> Add New Record
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="bg-soft-success p-3 rounded-3 me-3" style="background: #ecfdf5; color: #10b981;">
                    <i class="fas fa-wallet fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Collected Fees</small>
                    <h4 class="fw-bold mb-0 text-dark">PKR {{ number_format($fees->sum('paid_amount')) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
            <div class="d-flex align-items-center">
                <div class="bg-soft-danger p-3 rounded-3 me-3" style="background: #fef2f2; color: #ef4444;">
                    <i class="fas fa-hand-holding-usd fa-lg"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Pending Balance</small>
                    <h4 class="fw-bold mb-0 text-dark">PKR {{ number_format($fees->sum('remaining')) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom-0">
        <h5 class="fw-bold mb-0 text-dark">Transactions History</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">Student Name</th>
                        <th class="py-3">Total Amount</th>
                        <th class="py-3">Paid</th>
                        <th class="py-3">Remaining</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="fas fa-user text-muted small"></i>
                                </div>
                                <span class="fw-bold text-dark">{{ $fee->student->name }}</span>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">PKR {{ number_format($fee->amount) }}</td>
                        <td class="text-success fw-semibold">PKR {{ number_format($fee->paid_amount) }}</td>
                        <td class="text-danger fw-semibold">PKR {{ number_format($fee->remaining) }}</td>
                        <td>
                            @php
                                $statusClass = [
                                    'paid' => 'bg-soft-success text-success',
                                    'partial' => 'bg-soft-warning text-warning',
                                    'unpaid' => 'bg-soft-danger text-danger'
                                ][$fee->status] ?? 'bg-light text-muted';
                                
                                $statusStyle = [
                                    'paid' => 'background: #ecfdf5;',
                                    'partial' => 'background: #fffbeb;',
                                    'unpaid' => 'background: #fef2f2;'
                                ][$fee->status] ?? '';
                            @endphp
                            <span class="badge px-3 py-2 rounded-pill fw-medium {{ $statusClass }}" style="{{ $statusStyle }}">
                                <i class="fas fa-circle me-1 small" style="font-size: 8px;"></i>
                                {{ ucfirst($fee->status) }}
                            </span>
                        </td>
                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('fees.edit', $fee->id) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light rounded-2 text-primary debug-edit-link" title="Update Ledger" onclick="fetch(this.href, {credentials: 'include'}).then(r => console.log('Edit fetch', this.href, 'status', r.status)).catch(e => console.error('Edit fetch error', e));">
                                    <i class="fas fa-pen-nib"></i>
                                </a>
                                <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Waqai is record ko delete karna chahte hain?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light rounded-2 text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-receipt display-4 text-light mb-3 d-block"></i>
                            <span class="text-muted">No fee records found for the current period.</span>
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
    /* Status Badge Soft Colors */
    .bg-soft-success { color: #059669 !important; }
    .bg-soft-warning { color: #d97706 !important; }
    .bg-soft-danger { color: #dc2626 !important; }
    
    .table thead th {
        font-weight: 600;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table tbody tr:hover {
        background-color: #fcfcfd;
    }

    .btn-light {
        background: #f1f5f9;
        border: none;
        padding: 5px 10px;
    }
</style>
@endsection