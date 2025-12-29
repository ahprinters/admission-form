<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOfficeEntry extends Model
{
    protected $fillable = [
        'student_id',
        'class_teacher_name',
        'class_teacher_signature_path',
        'accountant_name',
        'accountant_signature_path',
        'session_fee',
        'admission_fee',
        'monthly_fee_jan',
        'misc_fee',
        'principal_comment',
        'principal_signature_path',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
