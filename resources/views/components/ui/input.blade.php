@props(['label', 'type' => 'text'])

<div class="space-y-1">

    <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>

    <input
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition'
        ]) }}
    >

    @error($attributes->get('wire:model') ?? $attributes->get('wire:model.defer'))
        <span class="text-red-500 text-sm">
            {{ $message }}
        </span>
    @enderror

</div>
