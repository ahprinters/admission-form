<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentGuardian;
use App\Models\StudentCategoryFlag;
use App\Models\StudentEducation;
use App\Models\StudentDeclaration;
use App\Models\StudentAdmissionForm;
use App\Models\StudentOfficeEntry;
use App\Models\StudentDocument;
class Student extends Model
{
    protected $fillable = [
        'name_en', 'name_bn', 'email', 'class', 'roll_number', 'gender',
        'phone', 'date_of_birth', 'nid_birth_certificate', 'blood_group',
        'nationality', 'religion', 'address', 'is_active', 'current_step',
    'status', 'submitted_at',
    ];

    protected $casts = [
    'is_active' => 'boolean',
    'submitted_at' => 'datetime',
    'current_step' => 'integer',
];

    public function guardian()
    {
        return $this->hasOne(StudentGuardian::class);
    }

    public function categoryFlags()
        {
            return $this->hasOne(StudentCategoryFlag::class, 'student_id');
        }

    public function educations()
        {
            return $this->hasMany(StudentEducation::class, 'student_id');
        }

    public function declaration()
    {
        return $this->hasOne(StudentDeclaration::class);
    }
    public function admissionForm()
    {
        return $this->hasOne(StudentAdmissionForm::class);
    }

    public function officeEntry()
    {
        return $this->hasOne(StudentOfficeEntry::class);
    }

    public function documents()
    {
        return $this->hasMany(StudentDocument::class);
    }

}
