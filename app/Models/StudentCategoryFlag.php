<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCategoryFlag extends Model
{
    protected $fillable = [
        'student_id',
        'is_working',
        'is_landless',
        'is_foster',
        'is_freedom_fighter_child',
        'is_disabled',
        'is_orphan',
        'is_indigenous',
        'is_none',
    ];

    protected $casts = [
        'is_working' => 'boolean',
        'is_landless' => 'boolean',
        'is_foster' => 'boolean',
        'is_freedom_fighter_child' => 'boolean',
        'is_disabled' => 'boolean',
        'is_orphan' => 'boolean',
        'is_indigenous' => 'boolean',
        'is_none' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
