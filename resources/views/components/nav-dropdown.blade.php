@props(['icon', 'label'])

<div x-data="{ open: false }" class="w-full">
    <button
        @click="open = !open"
        type="button"
        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 rounded-lg group"
        :class="open ? 'bg-slate-50 text-blue-600' : ''"
    >
        <div class="flex items-center gap-3">
            <div class="text-slate-400 group-hover:text-blue-500">
                <flux:icon :icon="$icon" variant="mini" />
            </div>

            <span>{{ $label }}</span>
        </div>

        <svg
            class="w-4 h-4 transition-transform duration-200"
            :class="open ? 'rotate-180' : ''"
            fill="none" viewBox="0 0 24 24" stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-show="open"
        x-collapse
        x-cloak
        class="mt-1 ml-9 space-y-1 border-l border-slate-200"
    >
        {{ $slot }}
    </div>
</div>
