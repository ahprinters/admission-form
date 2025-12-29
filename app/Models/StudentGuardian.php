<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    protected $fillable = [
        'student_id',

        'father_name_en', 'father_name_bn', 'father_mobile',
        'mother_name_en', 'mother_name_bn', 'mother_mobile',

        'guardian_name', 'guardian_relation', 'guardian_mobile', 'whatsapp',

        'occupation', 'annual_income',
        'land_amount', 'family_members',
        'permanent_address', 'present_address',
        'children_in_madrasa',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
