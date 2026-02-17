<?php
//https://chatgpt.com/c/69900a08-ffc0-83a8-9564-e8ac2bead35f
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_fee_id',
        'amount',
        'paid_at',
    ];

    public function StudentFee()
    {
        return $this->belognsTo(StudentFee::class);
    }
}
