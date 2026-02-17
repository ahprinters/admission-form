<div>

    {{-- Success Message --}}
    @if(session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-green-500 text-white p-4 rounded-lg shadow">
            <div class="text-sm">Total Collected</div>
            <div class="text-xl font-bold">৳ {{ number_format($totalCollected, 2) }}</div>
        </div>

        <div class="bg-red-500 text-white p-4 rounded-lg shadow">
            <div class="text-sm">Total Pending</div>
            <div class="text-xl font-bold">৳ {{ number_format($totalPending, 2) }}</div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="flex gap-4 mb-4">
        <input type="text"
               wire:model.debounce.500ms="search"
               placeholder="Search student..."
               class="border rounded px-3 py-2 w-1/3">

        <select wire:model="status"
                class="border rounded px-3 py-2">
            <option value="all">All</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid</option>
            <option value="partial">Partial</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-left">Student</th>
                    <th class="p-3 text-left">Fee Type</th>
                    <th class="p-3 text-left">Total</th>
                    <th class ="p-3 text-left">Paid</th>
                    <th class="p-3 text-left">Remaining</th>
                    <th class="p-3 text-left">Due Date</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                    @php
                        $remaining = $fee->total_amount - $fee->paid_amount;
                    @endphp

                    <tr class="border-t dark:border-gray-700">
                        <td class="p-3">{{ $fee->student->name_en ?? '-' }}</td>
                        <td class="p-3">{{ $fee->feeType->name }}</td>

                        <td class="p-3">৳ {{ number_format($fee->total_amount, 2) }}</td>
                        <td class="p-3">৳ {{ number_format($fee->paid_amount, 2) }}</td>
                        <td class="p-3">৳ {{ number_format($remaining, 2) }}</td>

                        <td class="p-3">{{ $fee->due_date ?? '-' }}</td>

                         {{-- Status --}}
                        <td class="p-3">
                            @if($fee->paid_amount == 0)
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">Unpaid</span>
                            @elseif($fee->paid_amount < $fee->total_amount)
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">Partial</span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Paid</span>
                            @endif
                        </td>

                        {{-- Action --}}
                        <td class="p-3">
                            @if($remaining > 0)
                                <div class="flex gap-2 items-center">
                                    <input type="number"
                                           wire:model.defer="payment_amount"
                                           placeholder="Amount"
                                           class="border rounded px-2 py-1 w-24 text-xs">

                                    <button wire:click="makePayment({{ $fee->id }})"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">
                                        Pay
                                    </button>
                                </div>
                            @else
                                <span class="text-green-600 text-xs">Completed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $fees->links() }}
        </div>
    </div>

</div>
