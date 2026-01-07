<?php

namespace App\Exports;

use Illuminate\Collections\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FeesExport implements FromCollection, WithHeadings
{
    protected $fees;

    public function __construct($fees)
    {
        $this->fees = $fees;
    }

    public function collection()
    {
        return $this->fees->map(function ($f) {
            return collect([
                'id' => $f->id,
                'student' => $f->student->name ?? '',
                'amount' => $f->amount,
                'paid_amount' => $f->paid_amount,
                'remaining' => $f->remaining,
                'status' => $f->status,
                'due_date' => $f->due_date,
                'created_at' => $f->created_at,
            ]);
        });
    }

    public function headings(): array
    {
        return ['ID', 'Student', 'Amount', 'Paid', 'Remaining', 'Status', 'Due Date', 'Created At'];
    }
}
