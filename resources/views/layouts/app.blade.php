<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="48x48">

        <!-- Meta Description -->
        <meta name="description" content="Eazy Passport, aplikasi manajemen layanan imigrasi untuk Kantor Imigrasi Kelas I Non TPI Pati. Mudah, cepat, dan efisien.">

        <!-- Meta Keywords (opsional, SEO) -->
        <meta name="keywords" content="Eazy Passport, Imigrasi Pati, layanan imigrasi online, manajemen paspor">

        <!-- Author -->
        <meta name="author" content="Kantor Imigrasi Kelas I Non TPI Pati">

        <!-- Viewport (responsive) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Open Graph / Social Preview -->
        <meta property="og:title" content="Eazy Passport | Kantor Imigrasi Kelas I Non TPI Pati">
        <meta property="og:description" content="Eazy Passport, aplikasi manajemen layanan imigrasi untuk Kantor Imigrasi Kelas I Non TPI Pati. Mudah, cepat, dan efisien.">
        <meta property="og:image" content="{{ asset('img/preview-image.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Eazy Passport | Kantor Imigrasi Kelas I Non TPI Pati">
        <meta name="twitter:description" content="Eazy Passport, aplikasi manajemen layanan imigrasi untuk Kantor Imigrasi Kelas I Non TPI Pati. Mudah, cepat, dan efisien.">
        <meta name="twitter:image" content="{{ asset('img/preview-image.png') }}">

        <title>{{ config('app.name', 'Eazy Passport | Kantor Imigrasi Kelas I Non TPI Pati') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <div class="pt-16">
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer id="contact" class="bg-blue-900 text-white py-10 mt-10">
                <div class="max-w-6xl mx-auto px-6 text-center">
                    <h3 class="text-lg font-semibold mb-4">Kantor Imigrasi Kelas I Non TPI Pati</h3>
                    <p class="text-gray-200 mb-2">Jl. Raya Pati-Kudus Km.7 No.1 Kec. Margorejo, Lumpur, Bumirejo, Kec. Pati, Kabupaten Pati, Jawa Tengah 5916</p>
                    <p class="text-gray-300 mb-6">Telepon: +62 812 5703 8946 | Email: info@imigrasipati.go.id</p>
                    <p class="text-sm text-gray-400">© 2025 Eazy Passport. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
