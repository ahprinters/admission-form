<div class = "max-w-xl mx-auto">
 @if(session()->has ('success'))
    <div class = "bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-4">
        <h2 class = "tex-lg font-semibold mb-4">Assign Fee</h2>

        <form wire:submit.prevent="assignFee" class = "space-y-4">

            {{-- student Select --}}
            <div>
                <label class="block text-sm mb-1">
                    Select Student
                </label>
                <select wire:model="student_id" class = "w-full border rounded px-3 py-2">
                    <option value = ""> -- Select Student --</option>
                    @foreach($students as $student)
                    <option value = "{{ $student->id }}">{{  $student->name_en }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Amount --}}
            <div>
                <label class="block text-sm mb-1"> Total Amount</label>
                <input type= "number" wire:model="total_amount"
                class="w-full border rounded px-3 py-2" placeholder = "Enter amount">
            </div>

            {{-- Due Date --}}
            <div>
                <label class="block text-sm mb-1">Due Date</label>
                <input type="date"
                class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Assign Fee
            </button>
        </form>
    </div>
</div>
