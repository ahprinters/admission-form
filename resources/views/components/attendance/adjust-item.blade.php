@props(['item'])

<label class="flex items-center gap-3 p-3 rounded-xl border">
    <input
        type="checkbox"
        class="rounded border-gray-300 text-black"
        wire:model.live="selectedAdjustIds"
        value="{{ $item['id'] ?? '' }}"
    >

    <div class="text-sm">
        <div class="font-medium">{{ $item['date'] ?? 'Date' }}</div>
        <div class="text-gray-600 text-xs">Attendance ID: {{ $item['id'] ?? '-' }}</div>

        @if(!empty($item['remarks']))
            <div class="text-gray-600 text-xs">Remarks: {{ $item['remarks'] }}</div>
        @endif
    </div>
</label>
