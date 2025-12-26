@props([
    'name',
    'label' => null,
    'rows' => 4,
    'placeholder' => '',
    'model' => null,
    'wire' => 'defer',
    'hint' => null,
])

@php
    use App\Support\FormField;

    $hasError = $errors->has($name);
    $field = FormField::make($name, $attributes, $model, $wire);

    $classes = trim(
        $field['baseControlClass'].' '
        .FormField::extra('textarea').' '
        .FormField::stateClass($hasError)
    );
@endphp

<div class="{{ $field['wrapClass'] }}">
    @if($label)
        <label for="{{ $field['id'] }}" class="{{ $field['labelClass'] }}">
            {{ $label }}
        </label>
    @endif

    <textarea
        id="{{ $field['id'] }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @if(!$field['wireModelAttr'])
            {{ $field['defaultWireDirective'] }}="{{ $field['modelName'] }}"
        @endif
        {{ $attributes->merge(['class' => $classes]) }}
    ></textarea>

    @if($hint)
        <div class="{{ $field['hintClass'] }}">{{ $hint }}</div>
    @endif

    <x-input-error :name="$name" />
</div>
