@props([
    'name',
    'label' => null,
    'options' => [],
    'placeholder' => 'নির্বাচন করুন',
    'icon' => null,
    'model' => null,
    'wire' => 'defer',
    'hint' => null,
])

@php
    use App\Support\FormField;

    $hasError = $errors->has($name);
    $field = FormField::make($name, $attributes, $model, $wire, hasIcon: (bool) $icon);

    $classes = trim(
        $field['baseControlClass'].' '
        .FormField::extra('select').' '
        .FormField::stateClass($hasError)
    );
@endphp

<div class="{{ $field['wrapClass'] }}">
    @if($label)
        <label for="{{ $field['id'] }}" class="{{ $field['labelClass'] }}">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <flux:icon :icon="$icon" variant="mini" />
            </div>
        @endif

        <select
            id="{{ $field['id'] }}"
            @if(!$field['wireModelAttr'])
                {{ $field['defaultWireDirective'] }}="{{ $field['modelName'] }}"
            @endif
            {{ $attributes->merge(['class' => $classes]) }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

        {{-- dropdown chevron --}}
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
            </svg>
        </div>
    </div>

    @if($hint)
        <div class="{{ $field['hintClass'] }}">{{ $hint }}</div>
    @endif

    <x-input-error :name="$name" />
</div>
