<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">

        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-indigo-600" />
            </a>
        </div>

        <!-- Form Container -->
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/30">
            {{ $slot }}
        </div>

    </div>
</body>
</html>