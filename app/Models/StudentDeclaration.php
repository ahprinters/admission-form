<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDeclaration extends Model
{
    protected $fillable = [
        'student_id',
        'student_commitment',
        'guardian_declaration',
        'student_signature_path',
        'guardian_signature_path',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
