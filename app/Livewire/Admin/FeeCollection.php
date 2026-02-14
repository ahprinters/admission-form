<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentFee;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.admin')]


class FeeCollection extends Component
{

public function markAsPaid($id)
    {
        StudentFee::where('id', $id)->update([
            'is_paid' => true,
            'paid_at' => now(),
        ]);
        session()->flash('message', 'ফি সফলভাবে পেইড মার্ক করা হয়েছে!');

    }

public function render()
    {
        $fees = StudentFee::with(['student', 'feeType'])->latest()->get();
        return view('livewire.admin.fee-collection', [
            'fees' => $fees,
        ]);
    }
}

