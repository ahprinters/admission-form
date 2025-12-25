@props(['name', 'title'])

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto"
>
    <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity"></div>

    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg max-w-lg w-full p-6 shadow-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
                <button x-on:click="show = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
