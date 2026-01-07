<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'amount',
        'paid_amount',
        'status',
        'due_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Remaining balance
    public function getRemainingAttribute()
    {
        return $this->amount - $this->paid_amount;
    }
    
}
