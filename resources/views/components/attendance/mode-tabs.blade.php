@props([
    'mode' => 'class',
])

<div class="flex items-center gap-2">
    <x-button
        type="button"
        variant="{{ $mode === 'class' ? 'primary' : 'secondary' }}"
        wire:click="$set('mode','class')"
    >
        Class
    </x-button>

    <x-button
        type="button"
        variant="{{ $mode === 'student' ? 'primary' : 'secondary' }}"
        wire:click="$set('mode','student')"
    >
        Student
    </x-button>

    <x-button
        type="button"
        variant="{{ $mode === 'adjust' ? 'primary' : 'secondary' }}"
        wire:click="$set('mode','adjust')"
    >
        Adjust
    </x-button>
</div>
