<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: transparent !important;
            background-image: url('{{ asset('assets/images/background/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgb(0 0 0 / 0.5);
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>

<body class="relative font-sans antialiased text-white overflow-x-hidden min-h-screen">

    <div class="relative z-10 flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
        <div
            class="flex w-full max-w-md flex-col gap-6 bg-white/70 backdrop-blur-md rounded-3xl p-8 shadow-2xl text-black">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                    class="w-28 h-28 object-contain drop-shadow-lg mb-2">
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            {{ $slot }}
        </div>
    </div>
    @fluxScripts

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const messages = @json($errors->all());
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    html: '<ul style="text-align:left;margin:0;padding-left:1.2em">' + messages.map(m => `<li>${m}</li>`).join('') + '</ul>',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#FF8A3D',
                    customClass: { popup: 'swal-auth-popup' },
                });
            });
        </script>
    @elseif (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('status')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#FF8A3D',
                    timer: 4000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif
</body>

</html>
