<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxAppearance

</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">

        <livewire:shared.sidebar />
        <main class="flex-1 flex flex-col">
            <header class="h-16 bg-white shadow flex items-center justify-between px-8">
                <button class="md:hidden text-gray-600">Menu</button>
                <div class="font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
            </header>

            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
    @fluxScripts()

</body>
</html>
