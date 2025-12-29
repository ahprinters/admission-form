<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAdmissionForm extends Model
{
    protected $fillable = [
        'student_id',
        'generated_pdf_path',
        'signed_pdf_path',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
