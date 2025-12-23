<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-slate-700">
                Admin Panel
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="/dashboard" class="block py-2.5 px-4 rounded transition hover:bg-slate-700">Dashboard</a>
                <a href="/students" class="block py-2.5 px-4 rounded transition hover:bg-slate-700">Student List</a>
                <a href="/student/create" class="block py-2.5 px-4 rounded transition hover:bg-slate-700">Add Student</a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <button wire:click="logout" class="w-full text-left py-2 px-4 text-red-400 hover:text-red-300">Logout</button>
            </div>
        </aside>

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
</body>
</html>
