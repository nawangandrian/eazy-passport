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
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer id="contact" class="bg-blue-900 text-white py-10 mt-10">
                <div class="max-w-6xl mx-auto px-6 text-center">
                    <h3 class="text-lg font-semibold mb-4">Kantor Imigrasi Kelas I Non TPI Pati</h3>
                    <p class="text-gray-200 mb-2">Jl. Dr. Susanto No. 10, Pati, Jawa Tengah</p>
                    <p class="text-gray-300 mb-6">Telepon: (0295) 381708 | Email: info@imigrasipati.go.id</p>
                    <p class="text-sm text-gray-400">© 2025 Eazy Passport. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
