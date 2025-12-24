@props([
    'icon' => 'academic-cap',
    'label' => 'Card Title',
    'value' => '0',
    'color' => null,
    'status' => null,
    'description' => null,
    'progress' => null // percentage value (0–100)
])

@php
    $statusColors = [
        'success' => 'green',
        'warning' => 'yellow',
        'danger'  => 'red',
        'info'    => 'blue',
    ];

    $finalColor = $color ?? ($statusColors[$status] ?? 'gray');
@endphp

<div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-5 w-full transition transform hover:-translate-y-1 hover:shadow-lg">
    <div class="flex items-center gap-3">
        <div class="p-2 rounded-full bg-gradient-to-tr from-{{ $finalColor }}-100 to-{{ $finalColor }}-200">
            <x-dynamic-component :component="'heroicon-o-' . $icon" class="h-6 w-6 text-{{ $finalColor }}-600" />
        </div>
        <div class="text-base font-semibold text-gray-600">{{ $label }}</div>
    </div>

    <div class="mt-4 ml-8 text-4xl font-extrabold tracking-tight text-gray-900">
        {{ $value }}
    </div>

    @if($description)
        <div class="ml-8 mt-1 text-sm text-gray-500">
            {{ $description }}
        </div>
    @endif

    @if(is_numeric($progress))
        <div class="ml-8 mt-4">
            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-{{ $finalColor }}-500 transition-all duration-500" style="width: {{ $progress }}%;"></div>
            </div>
            <div class="text-xs text-gray-500 mt-1">{{ $progress }}% complete</div>
        </div>
    @endif
</div>
