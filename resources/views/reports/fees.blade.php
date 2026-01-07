<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fees Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f3f3f3; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>Fees Transaction History</h2>
    <p>Generated: {{ now()->toDateTimeString() }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th class="text-right">Amount</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Remaining</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Recorded</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
            <tr>
                <td>{{ $fee->id }}</td>
                <td>{{ $fee->student->name ?? '—' }}</td>
                <td class="text-right">{{ number_format($fee->amount) }}</td>
                <td class="text-right">{{ number_format($fee->paid_amount) }}</td>
                <td class="text-right">{{ number_format($fee->remaining) }}</td>
                <td>{{ ucfirst($fee->status) }}</td>
                <td>{{ $fee->due_date }}</td>
                <td>{{ $fee->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>