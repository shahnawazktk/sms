@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="d-none d-print-block mb-4 text-center border-bottom pb-3">
                <h2 class="fw-bold text-uppercase mb-0">Bright Future Public School</h2>
                <p class="mb-0 text-muted small">Street 12, Academic Block, Islamabad | Contact: +92 51 1234567</p>
                <h5 class="mt-3 text-decoration-underline">STUDENT FEE STATEMENT</h5>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-dark py-3 px-4 d-flex justify-content-between align-items-center d-print-none">
                    <div>
                        <h5 class="text-white mb-0 fw-bold"><i class="fas fa-file-invoice-dollar me-2 text-warning"></i>Fee Ledger</h5>
                        <small class="text-light opacity-75">Tracking financial records for {{ $student->name }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('students.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="text-muted fw-bold" width="120">Student Name:</td>
                                    <td class="fw-bold">{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">ID / Reg No:</td>
                                    <td>#{{ date('Y') }}-0{{ $student->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">Course/Class:</td>
                                    <td><span class="badge bg-soft-primary text-primary">{{ $student->course }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="p-3 rounded-4 bg-light border d-inline-block shadow-sm">
                                <span class="text-muted small fw-bold text-uppercase d-block">Net Balance Due</span>
                                <h3 class="fw-black mb-0 {{ ($totalPaid - $totalDue) < 0 ? 'text-danger' : 'text-success' }}">
                                    PKR {{ number_format(abs($totalPaid - $totalDue)) }}
                                    <small style="font-size: 0.5em;">{{ ($totalPaid - $totalDue) < 0 ? '(Arrears)' : '(Advance)' }}</small>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-5 d-print-none">
                        <div class="col-md-4">
                            <div class="card border-0 bg-success bg-opacity-10 p-3 h-100 border-start border-success border-4 rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-success fw-bold small text-uppercase mb-1">Total Paid</h6>
                                        <h4 class="fw-bold mb-0">PKR {{ number_format($totalPaid) }}</h4>
                                    </div>
                                    <i class="fas fa-check-circle text-success fa-2x opacity-25"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-danger bg-opacity-10 p-3 h-100 border-start border-danger border-4 rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-danger fw-bold small text-uppercase mb-1">Total Due</h6>
                                        <h4 class="fw-bold mb-0">PKR {{ number_format($totalDue) }}</h4>
                                    </div>
                                    <i class="fas fa-clock text-danger fa-2x opacity-25"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-primary bg-opacity-10 p-3 h-100 border-start border-primary border-4 rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-primary fw-bold small text-uppercase mb-1">Total Receivable</h6>
                                        <h4 class="fw-bold mb-0">PKR {{ number_format($totalPaid + $totalDue) }}</h4>
                                    </div>
                                    <i class="fas fa-calculator text-primary fa-2x opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead class="bg-light text-uppercase fw-bold" style="font-size: 11px;">
                                <tr>
                                    <th class="ps-3 py-3 border-bottom-0">#</th>
                                    <th class="py-3 border-bottom-0">Date</th>
                                    <th class="py-3 border-bottom-0">Transaction Detail</th>
                                    <th class="py-3 border-bottom-0 text-center">Status</th>
                                    <th class="py-3 border-bottom-0 text-end">Credit (Paid)</th>
                                    <th class="py-3 border-bottom-0 text-end text-danger">Debit (Due)</th>
                                    <th class="py-3 border-bottom-0 text-end pe-3">Running Balance</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @php $balance = 0; @endphp
                                @forelse($fees as $key => $fee)
                                @php
                                    $balance += $fee->paid_amount - $fee->due_amount;
                                @endphp
                                <tr>
                                    <td class="ps-3">{{ $key + 1 }}</td>
                                    <td class="fw-semibold">{{ \Carbon\Carbon::parse($fee->date)->format('d M, Y') }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $fee->description ?? 'Monthly Tuition Fee' }}</div>
                                        <small class="text-muted">Ref ID: TXN-{{ 1000 + $fee->id }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($fee->paid_amount >= $fee->due_amount && $fee->due_amount > 0)
                                            <span class="badge rounded-pill bg-success small">Full Paid</span>
                                        @elseif($fee->paid_amount > 0)
                                            <span class="badge rounded-pill bg-warning text-dark small">Partial</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger small">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-success fw-bold">+ {{ number_format($fee->paid_amount) }}</td>
                                    <td class="text-end text-danger">- {{ number_format($fee->due_amount) }}</td>
                                    <td class="text-end pe-3 fw-black {{ $balance < 0 ? 'text-danger' : 'text-dark' }}">
                                        PKR {{ number_format($balance) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-25"></i>
                                        No financial transactions found for this student.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 d-print-none text-center">
                    <p class="text-muted small mb-3"><i class="fas fa-info-circle me-1"></i> This ledger is computer-generated and does not require a physical signature.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button onclick="window.print()" class="btn btn-dark px-4 rounded-pill fw-bold">
                            <i class="fas fa-print me-2"></i> Print Official Ledger
                        </a>
                        <button class="btn btn-primary px-4 rounded-pill fw-bold">
                            <i class="fas fa-file-pdf me-2"></i> Download PDF
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-none d-print-block mt-5">
                <div class="d-flex justify-content-between">
                    <div class="text-center" style="width: 200px;">
                        <hr class="mb-1">
                        <p class="small fw-bold">Accountant Signature</p>
                    </div>
                    <div class="text-center" style="width: 200px;">
                        <hr class="mb-1">
                        <p class="small fw-bold">Principal/Stamp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .bg-soft-primary { background-color: #e0e7ff; }
    .table thead th { border-top: none; }
    
    @media print {
        @page { size: portrait; margin: 1cm; }
        body { background: #fff !important; }
        .card { border: 1px solid #eee !important; box-shadow: none !important; }
        .bg-success, .bg-danger, .bg-primary { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        .d-print-none { display: none !important; }
    }
</style>
@endsection