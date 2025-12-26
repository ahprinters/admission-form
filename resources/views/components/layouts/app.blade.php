<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admission Form' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxAppearance
</head>

<body class="bg-slate-50 dark:bg-slate-950">
    {{ $slot }}

    {{-- ✅ Toast (Alpine based) --}}
    <x-toast />

    @livewireScripts
    @fluxScripts()

    {{-- (Optional) SweetAlert2 - যদি আপনার swal window event দরকার হয় --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
