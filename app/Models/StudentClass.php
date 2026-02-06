<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
        'year',
    ];

    // সম্পর্কগুলো

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

}
