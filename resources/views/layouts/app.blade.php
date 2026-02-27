<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-300">
            <div class="navbar">
                <livewire:layout.navigation />
            </div>
            @if (session()->has('success'))
                <div class="bg-green-500 text-white p-2 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="bg-red-500 text-white p-2 rounded">
                    {{ session('error') }}
                </div>
            @elseif (session()->has('warning'))
                <div class="bg-yellow-500 text-white p-2 rounded">
                    {{ session('warning') }}
                </div>
            @elseif (session()->has('info'))
                <div class="bg-blue-500 text-white p-2 rounded">
                    {{ session('info') }}
                </div> 
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
