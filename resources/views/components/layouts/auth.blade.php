<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-blue-100 to-indigo-200
             dark:from-gray-900 dark:to-gray-800">

    {{ $slot }}

    @livewireScripts
</body>
</html>
