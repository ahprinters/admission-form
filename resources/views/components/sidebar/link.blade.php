@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="block px-4 py-2 rounded-lg text-sm transition
   {{ $active
        ? 'bg-blue-600 text-white'
        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
    {{ $slot }}
</a>
