@props([
    'name',
    'label' => null,
    // Livewire model binding property; defaults to $name
    'model' => null,
    // Labels for OFF/ON
    'off' => 'Absent',
    'on' => 'Present',
    // ...
    'disabled' => false,
])

@php
    $id = str_replace(['.', '[', ']'], '-', $name);
    $modelName = $model ?: $name;

    $wireModelAttr = collect($attributes->getAttributes())
        ->keys()
        ->first(fn($k) => str_starts_with($k, 'wire:model'));
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1 dark:text-gray-200">
            {{ $label }}
        </label>
    @endif

	    <label class="inline-flex items-center gap-3 cursor-pointer select-none">
	        <input
	            id="{{ $id }}"
	            type="checkbox"
	            class="peer sr-only"
	            @if(!$wireModelAttr)
	                wire:model.live="{{ $modelName }}"
	            @endif
	            @disabled($disabled)
	            {{ $attributes->except('class') }}
	        >

	        <div class="w-12 h-7 rounded-full border relative overflow-hidden transition
	                    bg-gray-200 dark:bg-gray-700
	                    peer-checked:bg-black">
	            <div class="absolute top-1 left-1 w-5 h-5 bg-white rounded-full transition-transform
	                        peer-checked:translate-x-5"></div>
	        </div>

	        <span class="text-sm font-medium text-gray-900 dark:text-white">
	            <span class="peer-checked:hidden">{{ $off }}</span>
	            <span class="hidden peer-checked:inline">{{ $on }}</span>
	        </span>
	    </label>

    <x-input-error :name="$name" />
</div>
