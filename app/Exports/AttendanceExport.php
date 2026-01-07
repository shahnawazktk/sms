<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $rows;

    public function __construct(Collection $rows)
    {
        $this->rows = $rows;
    }

    public function collection()
    {
        return $this->rows->map(function ($r) {
            return [
                'student_id' => $r['student_id'],
                'student_name' => $r['student_name'],
                'status' => $r['status'],
                'marked_by' => $r['marked_by'],
                'updated_at' => $r['updated_at'],
            ];
        });
    }

    public function headings(): array
    {
        return ['student_id', 'student_name', 'status', 'marked_by', 'updated_at'];
    }
}