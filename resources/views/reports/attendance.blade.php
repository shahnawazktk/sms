@php
    // a simple table for PDF export
@endphp
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f1f1f1; }
    </style>
</head>
<body>
    <h3>Attendance Report ({{ $from }} @if($from !== $to) - {{ $to }} @endif)</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Status</th>
                <th>Marked By</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r['student_name'] }}</td>
                <td>{{ ucfirst($r['status']) }}</td>
                <td>{{ $r['marked_by'] ?? '—' }}</td>
                <td>{{ $r['updated_at'] ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>