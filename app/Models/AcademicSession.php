<?php

namespace App\Models;
use App\Models\Exam;

use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'session_id');
    }

}
