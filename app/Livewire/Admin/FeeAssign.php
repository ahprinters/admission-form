<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Student;
use App\Models\FeeType;
use App\Models\StudentFee;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]

class FeeAssign extends Component
{

    public $student_id;
    public $fee_type_id;
    public $total_amount;
    public $due_date;

    public function assignFee()
    {
        $this->validate([
        'student_id'    => 'required|exists:students, id',
        'fee_type_id'   => 'required|exists:fee_types_id',
        'total_amount'        => 'required|numeric|min:0',
        'due_date'      => 'nullable|date',

        ]);

        StudentFee::create([
            'student_id'    => $this->student_id,
            'fee_type_id'   => $this->fee_type_id,
            'total_amount'        => $this->total_amount,
            'paid_amount'   =>0, //default unpaid
            'due_date'      => $this->due_date,
        ]);

        session()->flash('success', 'Fee assigned successfully!');

        // Reset form
        $this->reset(['student_id', 'fee_type_id', 'total_amount', 'due_date']);

    }

public function render()
    {
        return view('livewire.admin.fee-assign', [
            'students' => Student::orderBy('name_en')->get(),
            'feeTypes' => FeeType::orderBy('name')->get(),
        ]);
    }
}
