<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'stream_name',
        'description',
    ];

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
