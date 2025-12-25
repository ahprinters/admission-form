@props(['name', 'label' => null, 'preview' => null])

<div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    class="w-full"
>
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <div class="mb-2">
        @if ($preview)
            <img src="{{ $preview->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg border">
        @else
            <div class="w-32 h-32 bg-gray-100 flex items-center justify-center rounded-lg border-2 border-dashed border-gray-300">
                <span class="text-gray-400 text-xs text-center p-2">কোনো ছবি নেই</span>
            </div>
        @endif
    </div>

    <div class="relative">
        <input
            type="file"
            id="{{ $name }}"
            wire:model="{{ $name }}"
            {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100']) }}
        >
    </div>

    <div x-show="isUploading" class="mt-2">
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-indigo-600 h-2.5 rounded-full" :style="`width: ${progress}%` transition: 'width 0.2s'"></div>
        </div>
        <span class="text-xs text-gray-500 mt-1" x-text="`আপলোড হচ্ছে: ${progress}%` shadow-sm"></span>
    </div>

    <x-input-error :name="$name" />
</div>
