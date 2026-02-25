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
<body class="font-sans antialiased bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-xl shadow-lg rounded-b-2xl border-b border-white/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-indigo-600">
                    EasyColoc
                </a>
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
                <a href="" class="text-gray-700 hover:text-indigo-600 transition">Colocations</a>
                <a href="" class="text-gray-700 hover:text-indigo-600 transition">Profile</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="py-2 px-4 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition shadow-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    @isset($header)
    <header class="bg-white/80 backdrop-blur-xl shadow-sm border-b border-white/30">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-extrabold text-gray-800">{{ $header }}</h1>
        </div>
    </header>
    @endisset

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        {{ $slot }}
    </main>

    <!-- Example Card Component -->
    {{-- 
    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Card Title</h2>
        <p class="text-gray-700">Content goes here...</p>
    </div>
    --}}

    <!-- Example Table Component -->
    {{-- 
    <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/30 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">john@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap">Member</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <button class="text-indigo-600 hover:text-indigo-800 font-semibold">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    --}}
    
</body>
</html>