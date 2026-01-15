<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'profile_image',
        'course_id', // FK to Course
    ];

    // Student belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Student has many fees
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}

