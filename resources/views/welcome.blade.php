<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Selamat Datang di Copas</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/images/logo/logo.png') }}" type="image/png">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-white overflow-x-hidden">
    <div class="relative min-h-screen flex items-center justify-center p-6">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/background/background.png') }}" alt="Forest Background"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full max-w-md flex flex-col items-center text-center">
            <!-- Logo -->
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                class="w-48 h-48 mb-2 object-contain drop-shadow-lg">

            <!-- Titles -->
            <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight drop-shadow-md">Selamat Datang di Kelas</h1>
            <p class="text-lg md:text-xl mb-8 drop-shadow">Belajar Lingkungan dengan Seru</p>

            <!-- Button -->
            <a href="{{ route('login') }}"
                class="w-full max-w-sm bg-[#FA8B43] hover:bg-[#E57A33] text-white font-medium py-3 px-6 rounded-md transition duration-150 mb-6 text-lg shadow-md">
                Mulai
            </a>

            <!-- Footer -->
            <p class="text-base drop-shadow">
                Belum Punya Akun Guru? <a href="{{ route('register') }}" class="font-bold hover:underline">Buat</a>
            </p>
        </div>
    </div>
</body>

</html>
