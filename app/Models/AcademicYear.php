<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
    'name',
    'start_year',
    'end_year',
    'is_active'

    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'start_year'=> 'integer',
        'end_year'  => 'integer',
    ];

    //an academic years has many classes

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
