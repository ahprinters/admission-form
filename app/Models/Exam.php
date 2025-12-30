<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicSession;

class Exam extends Model
{
    protected $fillable = [
        'exam_name',
        'start_date',
        'end_date',
        'semester_id',
        'student_class_id',
        'course_id',
        'session_id',
    ];
   public function semester() {
    return $this->belongsTo(Semester::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function studentClass() {
        return $this->belongsTo(StudentClass::class);
    }

    public function session() {
        return $this->belongsTo(Session::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
}
