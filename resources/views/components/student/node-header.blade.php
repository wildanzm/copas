@props(['progress'])
<div class="flex items-center py-6 w-full max-w-3xl mx-auto px-4 md:px-0 mb-6">
    <a href="{{ route('student.dashboard') }}"
        class="text-black font-bold hover:opacity-70 transition cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="black"
            class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>
    <div class="flex-1 flex justify-center px-4">
        <div
            class="w-full max-w-2xl h-4 border border-gray-400 rounded-full bg-white relative overflow-hidden shadow-inner">
            <div class="h-full bg-[#99CB3A] transition-all duration-500 rounded-full" style="width: {{ $progress }}%"></div>
        </div>
    </div>
    <div class="w-8"></div>
</div>
