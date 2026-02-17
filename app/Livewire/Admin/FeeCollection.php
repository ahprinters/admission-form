<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentFee;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.admin')]


class FeeCollection extends Component
{
    use WithPagination;

    public $search ='';
    public $status = 'all'; // all/ paid/ unpaid
    public $payment_amount;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function markAsPaid($id)
    {
        StudentFee::where('id', $id)->update([
            'is_paid' => true,
            'paid_at' => now(),
        ]);

        session()->flash('message', 'ফি সফলভাবে পেইড মার্ক করা হয়েছে!');

    }
    public function makePayment($feeId)
    {
        $fee = StudentFee::findOrFail($feeId);

        $this->validate([
            'payment_amount' => 'required|numaric|min:1'
        ]);

        //prevent overpayment
        if (($fee->paid_amount + $this->payment_amount) > $fee->total_amount) {
            session()->flash('error', 'payment exceeds total amount!');
            return;
        }

            // Save payment record
        $fee->payments()->create([
            'amount' => $this->payment_amount,
            'paid_at' => now(),
        ]);

        //Update paid amount
        $fee->payments()->create([
            'amount' =>$this->payment_amount,
            'paid_at'   =>now(),
        ]);

        //Update paid amount
        $fee->update([
        'paid_amount' => $fee->paid_amount + $this->payment_amount
        ]);
        $this->payment_amount = null;

        session()->flash('success', 'Payment added successfully!');

    }
public function render()
    {
        $fees = StudentFee::with('student', 'feeType')
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('name_en', 'like', "%{$this->search}%");
                });
            })
            ->when($this->status !== 'all', function ($query) {
                $query->where('is_paid', $this->status === 'paid');
            })
            ->latest()
            ->paginate(10);

        $totalCollected = StudentFee::where('is_paid', true)->sum('amount');
        $totalPending = StudentFee::where('is_paid', false)->sum('amount');

        return view('livewire.admin.fee-collection', [
            'fees' => $fees,
            'totalCollected' => $totalCollected,
            'totalPending' => $totalPending,
        ]);
    }
}
