<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;   // ✅ ADD THIS
use App\Models\StudentFee;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin')]
class FeeCollection extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all'; // all / paid / unpaid / partial
    public $pay_amount = [];

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function makePayment($feeId)
    {
        $fee = StudentFee::findOrFail($feeId);

        $amount = $this->pay_amount[$feeId] ?? 0;

        if ($amount <= 0) {
            session()->flash('error', 'Enter valid amount.');
            return;
        }

        // Prevent overpayment
        if (($fee->paid_amount + $amount) > $fee->total_amount) {
            session()->flash('error', 'Payment exceeds total amount!');
            return;
        }

        // Update paid_amount
        $fee->update([
            'paid_amount' => $fee->paid_amount + $amount
        ]);

        // Reset input
        $this->pay_amount[$feeId] = null;

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
                if ($this->status === 'paid') {
                    $query->whereColumn('paid_amount', '>=', 'total_amount');
                }

                if ($this->status === 'unpaid') {
                    $query->where('paid_amount', 0);
                }

                if ($this->status === 'partial') {
                    $query->where('paid_amount', '>', 0)
                          ->whereColumn('paid_amount', '<', 'total_amount');
                }
            })
            ->latest()
            ->paginate(10);

        // Dynamic totals
        $totalCollected = StudentFee::sum('paid_amount');
        $totalPending = StudentFee::sum(
            DB::raw('total_amount - paid_amount')
        );

        return view('livewire.admin.fee-collection', [
            'fees' => $fees,
            'totalCollected' => $totalCollected,
            'totalPending' => $totalPending,
        ]);
    }
}
