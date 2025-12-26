@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    // Livewire model binding property; defaults to $name
    'model' => null,
    // Optional help text under the input
    'hint' => null,
])

@php
    // If the component is used for nested props like `filters.search`,
    // the HTML id must be safe.
    $id = str_replace(['.', '[', ']'], '-', $name);
    $modelName = $model ?: $name;

    // Allow overriding wire:model.* from the outside.
    $wireModelAttr = collect($attributes->getAttributes())
        ->keys()
        ->first(fn($k) => str_starts_with($k, 'wire:model'));

    $hasError = $errors->has($name);

    $base = 'block w-full rounded-lg px-3 py-2 border transition focus:outline-none focus:ring-2';
    $colors = 'bg-white text-gray-900 border-gray-300 placeholder-gray-400 '
        .'dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:placeholder-gray-500';
    $focus = $hasError
        ? 'focus:ring-red-500 focus:border-red-500'
        : 'focus:ring-indigo-500 focus:border-indigo-500';
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        @if(!$wireModelAttr)
            wire:model.live="{{ $modelName }}"
        @endif
        {{ $attributes->merge([
            'class' => $base.' '.$colors.' '.$focus.($hasError ? ' border-red-300' : '')
        ]) }}
    >

    @if($hint)
        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $hint }}</div>
    @endif

    <x-input-error :name="$name" />
</div>
