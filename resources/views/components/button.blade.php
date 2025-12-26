@props([
    'variant' => 'primary', // primary|secondary|danger|ghost
    'size' => 'md', // sm|md|lg
    'loadingTarget' => null, // wire:target name for loading state
])

@php
    $base = 'inline-flex items-center justify-center rounded-lg font-semibold transition focus:outline-none focus:ring-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
    ];

    $variants = [
        'primary' => 'bg-black text-white hover:bg-black/90 focus:ring-black/20',
        'secondary' => 'bg-white text-gray-900 border border-gray-200 hover:bg-gray-50 focus:ring-black/10 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-200',
        'ghost' => 'bg-transparent text-gray-900 hover:bg-gray-100 focus:ring-black/10 dark:text-white dark:hover:bg-gray-800',
    ];

    $cls = $base.' '.($sizes[$size] ?? $sizes['md']).' '.($variants[$variant] ?? $variants['primary']);

    // Build extra attributes safely (no Blade directives inside tag)
    $extra = [];
    if ($loadingTarget) {
        $extra['wire:loading.attr'] = 'disabled';
        $extra['wire:target'] = $loadingTarget;
    }
@endphp

<button {{ $attributes->merge(['class' => $cls])->merge($extra) }}>
    @if($loadingTarget)
        <span class="inline-flex items-center gap-2" wire:loading wire:target="{{ $loadingTarget }}">
            <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        </span>

        <span wire:loading.remove wire:target="{{ $loadingTarget }}">
            {{ $slot }}
        </span>
    @else
        {{ $slot }}
    @endif
</button>
