<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $fillable = [
        'student_id',
        'fee_type_id',
        'amount',
        'due_date',
        'total_amount',
        'paid_amount',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
