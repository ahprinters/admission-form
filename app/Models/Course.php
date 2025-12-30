<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{

    use HasFactory;
    protected $fillable = ['course_name', 'course_type', 'class_id', 'semester_id', 'session_id'];


    public function studentClass()
    {
        return $this->belongsTo(\App\Models\StudentClass::class, 'class_id');
    }

    public function semester()
    {
        return $this->belongsTo(\App\Models\Semester::class, 'semester_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(\App\Models\AcademicSession::class, 'session_id');
    }

}

