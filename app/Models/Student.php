<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name_en', 'name_bn', 'email', 'class', 'roll_number', 'gender',
        'phone', 'date_of_birth', 'nid_birth_certificate', 'blood_group',
        'nationality', 'religion', 'address', 'is_active'
    ];
}
