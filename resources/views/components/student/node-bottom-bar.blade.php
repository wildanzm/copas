@props(['submitAction', 'nextRoute' => null, 'message' => null])
@if (session()->has('message'))
    <div class="w-full bg-[#96C7F7] py-6 sm:py-8 mt-6" x-init="playSuccessEffects()">
        <div
            class="max-w-3xl mx-auto px-6 w-full flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0">
            <div class="flex items-center gap-4 md:gap-5">
                <div
                    class="w-14 h-14 md:w-16 md:h-16 bg-[#E8F2FC] rounded-full flex items-center justify-center shrink-0">
                    <img src="{{ asset('assets/icons/etc/nice-job.png') }}" alt="Nice Job"
                        class="w-8 h-8 md:w-10 md:h-10 object-contain" loading="lazy">
                </div>
                <span class="font-black text-xl md:text-2xl text-black tracking-wide">{{ $message ?? 'Kerja Bagus!' }}</span>
            </div>
            @if($nextRoute)
            <a href="{{ $nextRoute }}" wire:navigate
                class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                SELANJUTNYA
            </a>
            @endif
        </div>
    </div>
@else
    <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
        <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
            <button wire:click="{{ $submitAction }}"
                class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto">
                KIRIM
            </button>
        </div>
    </div>
@endif
