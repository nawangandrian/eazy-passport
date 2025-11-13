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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <!--<a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a> -->
            </div>

            <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
