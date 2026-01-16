<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'profile_image',
        'course_id',

        // Professional fields
        'status',               // active | graduated | blacklist
        'termination_date',
        'termination_reason',
        'termination_remarks',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'dob'               => 'date',
        'termination_date'  => 'date',
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [
        'status' => 'active',
    ];

    /* =======================
     |  RELATIONSHIPS
     =======================*/

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

    /* =======================
     |  SCOPES (Filters)
     =======================*/

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeGraduated($query)
    {
        return $query->where('status', 'graduated');
    }

    public function scopeBlacklist($query)
    {
        return $query->where('status', 'blacklist');
    }

    /* =======================
     |  BUSINESS LOGIC
     =======================*/

    /**
     * Terminate (Blacklist) student
     */
    public function terminate($reason = null, $remarks = null, $date = null)
    {
        $this->update([
            'status'              => 'blacklist',
            'termination_reason'  => $reason,
            'termination_remarks' => $remarks,
            'termination_date'    => $date ?? now(),
        ]);

        $this->delete(); // soft delete
    }

    /**
     * Graduate student
     */
    public function graduate()
    {
        $this->update([
            'status' => 'graduated',
        ]);
    }

    /**
     * Restore terminated student
     */
    public function restoreStudent()
    {
        $this->restore();

        $this->update([
            'status'              => 'active',
            'termination_reason'  => null,
            'termination_remarks' => null,
            'termination_date'    => null,
        ]);
    }

    /* =======================
     |  ACCESSORS
     =======================*/

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image)
            : asset('images/default-student.png');
    }
}
