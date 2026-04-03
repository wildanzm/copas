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
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="flex h-screen overflow-hidden relative">

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
        <aside
            :class="[
                sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
                sidebarCollapsed ? 'lg:w-24' : 'lg:w-72'
            ]"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 flex flex-col justify-between bg-[#1056A4] text-white flex-shrink-0 transform transition-all duration-300 ease-in-out pt-16 lg:pt-0">
            <div class="overflow-y-auto flex-1 overflow-x-hidden">
                <!-- Logo Area (Desktop) -->
                <div class="hidden lg:flex items-center"
                    :class="sidebarCollapsed ? 'justify-center px-0 py-8' : 'justify-between px-8 py-8'">
                    <img x-show="!sidebarCollapsed" src="{{ asset('assets/images/logo/logo text.png') }}"
                        class="h-16 w-auto object-contain transition-all duration-300" alt="COPAS">

                    <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="p-2 hover:bg-white/10 rounded-xl transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="w-7 h-7 transform transition-transform"
                            :class="sidebarCollapsed ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="mt-4 flex flex-col gap-3" :class="sidebarCollapsed ? 'px-4 lg:px-2' : 'px-4'">
                    <!-- Dashboard (Active) -->
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center gap-4 py-3.5 rounded-full bg-[#1A6DD2] text-white italic font-bold text-xl shadow-md transition-all group"
                        :class="sidebarCollapsed ? 'justify-center px-0 lg:w-16 lg:mx-auto' : 'px-6'">
                        <img src="{{ asset('assets/icons/dashboard/dashboard.png') }}"
                            class="w-8 h-8 object-contain shrink-0" alt="Dashboard">
                        <span x-show="!sidebarCollapsed"
                            class="whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                    </a>

                    <!-- Kuis -->
                    <a href="#"
                        class="flex items-center gap-4 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-all group"
                        :class="sidebarCollapsed ? 'justify-center px-0 lg:w-16 lg:mx-auto' : 'px-6'">
                        <img src="{{ asset('assets/icons/dashboard/kuis.png') }}"
                            class="w-8 h-8 object-contain shrink-0" alt="Kuis">
                        <span x-show="!sidebarCollapsed"
                            class="whitespace-nowrap transition-opacity duration-300">Kuis</span>
                    </a>

                    <!-- Peringkat -->
                    <a href="#"
                        class="flex items-center gap-4 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-all group"
                        :class="sidebarCollapsed ? 'justify-center px-0 lg:w-16 lg:mx-auto' : 'px-6'">
                        <img src="{{ asset('assets/icons/dashboard/peringkat.png') }}"
                            class="w-8 h-8 object-contain shrink-0" alt="Peringkat">
                        <span x-show="!sidebarCollapsed"
                            class="whitespace-nowrap transition-opacity duration-300">Peringkat</span>
                    </a>

                    <!-- Profile -->
                    <a href="#"
                        class="flex items-center gap-4 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-all group"
                        :class="sidebarCollapsed ? 'justify-center px-0 lg:w-16 lg:mx-auto' : 'px-6'">
                        <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                            class="w-8 h-8 object-contain shrink-0" alt="Profile">
                        <span x-show="!sidebarCollapsed"
                            class="whitespace-nowrap transition-opacity duration-300">Profile</span>
                    </a>

                    <!-- Tentang -->
                    <a href="#"
                        class="flex items-center gap-4 py-3.5 rounded-full hover:bg-[#1A6DD2]/50 text-white italic font-bold text-xl transition-all group"
                        :class="sidebarCollapsed ? 'justify-center px-0 lg:w-16 lg:mx-auto' : 'px-6'">
                        <img src="{{ asset('assets/icons/dashboard/tentang.png') }}"
                            class="w-8 h-8 object-contain shrink-0" alt="Tentang">
                        <span x-show="!sidebarCollapsed"
                            class="whitespace-nowrap transition-opacity duration-300">Tentang</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Action: Log Out -->
            <div class="pb-10" :class="sidebarCollapsed ? 'px-4 lg:px-2 flex justify-center' : 'px-8'">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-4 text-white italic font-bold text-lg hover:text-gray-200 transition-all w-full"
                        :class="sidebarCollapsed ?
                            'justify-center lg:w-16 lg:mx-auto lg:p-3 lg:hover:bg-white/10 lg:rounded-xl' : ''">
                        <!-- Logout Icon -->
                        <div class="flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </div>
                        <span x-show="!sidebarCollapsed" class="whitespace-nowrap transition-opacity duration-300">Log
                            Out</span>
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
