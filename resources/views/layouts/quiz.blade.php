<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    @livewireStyles
    <style>
        /* Custom typography or scrollbar can go here */
    </style>
</head>

<body class="antialiased min-h-screen text-gray-900 overflow-x-hidden">
    {{ $slot }}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</body>

</html>
