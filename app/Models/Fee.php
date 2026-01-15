<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'course_id', // optional, if fee is tied to a course
        'amount',
        'paid_amount',
        'status',
        'due_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Remaining balance
    public function getRemainingAttribute()
    {
        return $this->amount - $this->paid_amount;
    }
}

