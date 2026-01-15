<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'credit_hours',
    ];

    // Course has many students
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Optional: course has many fees
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
