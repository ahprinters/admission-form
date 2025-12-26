@props([
    'open' => 'openConfirm',
    'title' => 'Confirm',
    'message' => 'Are you sure?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmAction' => '',
    'loadingTarget' => '',
])

<div x-show="{{ $open }}" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl p-4 w-full max-w-md space-y-3">
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
                wire:click="{{ $confirmAction }}"
                @if(!empty($loadingTarget))
                    loadingTarget="{{ $loadingTarget }}"
                @endif
            >
                {{ $confirmText }}
            </x-button>
        </div>
    </div>
</div>
