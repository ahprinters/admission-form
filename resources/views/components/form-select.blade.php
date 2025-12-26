@props([
    'name',
    'label' => null,
    'options' => [],
    'placeholder' => 'নির্বাচন করুন',
    'icon' => null,
    // Livewire model binding property; defaults to $name
    'model' => null,
    // Optional help text under the select
    'hint' => null,
])

@php
    $id = str_replace(['.', '[', ']'], '-', $name);
    $modelName = $model ?: $name;

    // Allow overriding wire:model.* from outside.
    $wireModelAttr = collect($attributes->getAttributes())
        ->keys()
        ->first(fn($k) => str_starts_with($k, 'wire:model'));

    $hasError = $errors->has($name);

    $base = 'block w-full rounded-lg px-3 py-2 border transition focus:outline-none focus:ring-2';
    $padding = $icon ? 'pl-10 pr-3' : '';
    $colors = 'bg-white text-gray-900 border-gray-300 '
        .'dark:bg-gray-800 dark:text-white dark:border-gray-600';
    $focus = $hasError
        ? 'focus:ring-red-500 focus:border-red-500'
        : 'focus:ring-indigo-500 focus:border-indigo-500';

    $inputClasses = trim($base.' '.$padding.' '.$colors.' '.$focus.($hasError ? ' border-red-300' : ''));
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-slate-700 mb-1.5">
            {{ $label }}
        </label>
    @endif

    <div class="relative flex items-center">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                <flux:icon :icon="$icon" variant="mini" />
            </div>
        @endif

        <select
            id="{{ $id }}"
            @if(!$wireModelAttr)
                wire:model.live="{{ $modelName }}"
            @endif
            {{ $attributes->merge(['class' => $inputClasses]) }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>

    @if($hint)
        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $hint }}</div>
    @endif

    <x-input-error :name="$name" />
</div>
