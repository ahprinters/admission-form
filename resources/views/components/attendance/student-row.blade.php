@props(['student'])

@php
    $sid = (int) ($student['id'] ?? 0);
@endphp

<tr class="align-middle">
    <td class="py-3 pr-4">{{ $sid }}</td>
    <td class="py-3 pr-4">{{ $student['name'] ?? '-' }}</td>
    <td class="py-3 pr-4">{{ $student['roll'] ?? '-' }}</td>

    <td class="py-3 pr-4">
        <x-form-toggle
            name="statusByStudent.{{ $sid }}"
            on="Present"
            off="Absent"
            wire:model.live="statusByStudent.{{ $sid }}"
        />
    </td>

    <td class="py-3 pr-4">
        <x-form-input
            name="remarksByStudent.{{ $sid }}"
            placeholder="Optional"
            wire:model.live="remarksByStudent.{{ $sid }}"
            class="w-56"
        />
    </td>

    <td class="py-3 pr-4">
        <x-button type="button" variant="secondary" wire:click="switchToAdjust({{ $sid }})">
            Adjust
        </x-button>
    </td>
</tr>
