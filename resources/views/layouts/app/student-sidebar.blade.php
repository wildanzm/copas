<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
    @include('partials.head')
    @livewireStyles
    <style>
        /* Custom typography or scrollbar can go here */
    </style>
</head>

<body class="min-h-screen text-gray-900 bg-[#D9EEF9] font-sans">
    <!-- Page Wrapper -->
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden relative">

        <!-- Mobile Header (Visible only on small screens) -->
        <div
            class="lg:hidden absolute top-0 left-0 right-0 z-40 bg-[#1056A4] text-white flex items-center justify-between px-4 py-3 shadow-md">
            <img src="{{ asset('assets/images/logo/logo text.png') }}" class="h-10 w-auto object-contain" alt="COPAS">
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 -mr-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"
            @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 flex flex-col justify-between bg-[#1056A4] text-white flex-shrink-0 transform transition-transform duration-300 ease-in-out lg:translate-x-0 pt-16 lg:pt-0">
            <div class="overflow-y-auto flex-1">
                <!-- Logo Area (Desktop) -->
                <div class="hidden lg:block px-8 py-8">
                    <img src="{{ asset('assets/images/logo/logo text.png') }}" class="h-16 w-auto object-contain"
                        alt="COPAS">
                </div>

                <!-- Navigation -->
                <nav class="mt-4 flex flex-col gap-3 px-4">
                    <!-- Dashboard (Active) -->
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center gap-4 px-6 py-3.5 rounded-full bg-[#1A6DD2] text-white italic font-bold text-xl shadow-md">
                        <img src="{{ asset('assets/icons/dashboard/dashboard.png') }}" class="w-8 h-8 object-contain"
                            alt="Dashboard">
                        <span>Dashboard</span>
                    </a>

                    <!-- Kuis -->
                    <a href="#"
                        class="flex items-center gap-4 px-6 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-colors">
                        <img src="{{ asset('assets/icons/dashboard/kuis.png') }}" class="w-8 h-8 object-contain"
                            alt="Kuis">
                        <span>Kuis</span>
                    </a>

                    <!-- Peringkat -->
                    <a href="#"
                        class="flex items-center gap-4 px-6 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-colors">
                        <img src="{{ asset('assets/icons/dashboard/peringkat.png') }}" class="w-8 h-8 object-contain"
                            alt="Peringkat">
                        <span>Peringkat</span>
                    </a>

                    <!-- Profile -->
                    <a href="#"
                        class="flex items-center gap-4 px-6 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-colors">
                        <img src="{{ asset('assets/icons/dashboard/profil.png') }}" class="w-8 h-8 object-contain"
                            alt="Profile">
                        <span>Profile</span>
                    </a>

                    <!-- Tentang -->
                    <a href="#"
                        class="flex items-center gap-4 px-6 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-colors">
                        <img src="{{ asset('assets/icons/dashboard/tentang.png') }}" class="w-8 h-8 object-contain"
                            alt="Tentang">
                        <span>Tentang</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Action: Log Out -->
            <div class="px-8 pb-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-4 text-white italic font-bold text-lg hover:text-gray-200">
                        <!-- Logout Icon -->
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </div>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto w-full pt-16 lg:pt-0">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
