@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => ''
])

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            wire:model.blur="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'block w-full rounded-md shadow-sm sm:text-sm transition duration-150 ease-in-out ' .
                ($errors->has($name)
                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500'
                    : 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500')
            ]) }}
        >
    </div>

    <x-input-error :name="$name" />
</div>


{{-- <form wire:submit.prevent="save" class="space-y-6 bg-white p-6 rounded-xl shadow-sm border border-gray-100">

    <x-form-input
        name="name"
        label="পুরো নাম"
        placeholder="আপনার নাম লিখুন..."
    / --}}
