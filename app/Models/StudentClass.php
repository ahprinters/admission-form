<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'class_code',
        'is_active',
        'grade_id',
        'stream_id',
        'teacher_id',
        'academic_year_id',   // ✅ REQUIRED
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * A class belongs to an academic year
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * A class belongs to a grade
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * A class belongs to a stream (nullable)
     */
    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    /**
     * A class belongs to a teacher (class teacher)
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
