<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = ['semester_name', 'start_date', 'end_date', 'session_id'];

    public function academicSession()
    {
        return $this->belongsTo(\App\Models\AcademicSession::class, 'session_id');
    }
}
