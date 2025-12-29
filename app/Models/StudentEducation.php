<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    protected $table = 'student_educations';
    protected $fillable = [
        'student_id',
        'institution_name',
        'class_name',
        'pass_year',
        'gpa',
        'transfer_certificate_no',
        'transfer_certificate_date',
        'sort_order',
    ];

    protected $casts = [
        'pass_year' => 'integer',
        'transfer_certificate_date' => 'date',
        'sort_order' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
