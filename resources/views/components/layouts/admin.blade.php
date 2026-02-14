<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <livewire:shared.sidebar />

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col">

        {{-- Top Header --}}
        <header class="h-16 bg-white dark:bg-gray-800 shadow flex items-center justify-between px-8">
            <button class="md:hidden text-gray-600 dark:text-gray-300">
                ☰
            </button>

            <div class="font-medium text-gray-700 dark:text-gray-200">
                {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </header>

        {{-- Page Content --}}
        <div class="p-8">
            {{ $slot }}
        </div>

    </main>
</div>

@livewireScripts
</body>
</html>
