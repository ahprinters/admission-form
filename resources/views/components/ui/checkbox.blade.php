@props(['label'])

<label class="flex items-center space-x-2">
    <input
        type="checkbox"
        {{ $attributes->merge([
            'class' => 'rounded border-gray-300 focus:ring-blue-500'
            ]) }}

    <span class="text-sm text-gray-600 dark:text-gray-300">
        {{ $label }}
    </span>

</label>
