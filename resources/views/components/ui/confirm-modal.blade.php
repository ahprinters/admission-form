@props([
    'open' => 'openConfirm',
    'title' => 'Confirm',
    'message' => 'Are you sure?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmAction' => 'applyAdjust',
    'loadingTarget' => 'applyAdjust',
])

@php
    $target = $loadingTarget ?: $confirmAction;

    // Build attrs in PHP so Blade never parses directives inside tag attrs
    $btnAttrs = [];
    if (!empty($confirmAction)) {
        $btnAttrs['wire:click'] = $confirmAction;
    }
    if (!empty($target)) {
        $btnAttrs['wire:loading.attr'] = 'disabled';
        $btnAttrs['wire:target'] = $target;
    }
@endphp

<div x-show="{{ $open }}" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl p-4 w-full max-w-md space-y-3" @click.away="{{ $open }}=false">
        <div class="text-lg font-semibold">{{ $title }}</div>
        <div class="text-sm text-gray-600">{{ $message }}</div>

        <div class="flex justify-end gap-2">
            <x-button type="button" variant="secondary" @click="{{ $open }}=false">
                {{ $cancelText }}
            </x-button>

            <x-button
                type="button"
                variant="primary"
                @click="{{ $open }}=false"
                {{ $attributes->merge($btnAttrs) }}
            >
                {{ $confirmText }}
            </x-button>
        </div>
    </div>
</div>
