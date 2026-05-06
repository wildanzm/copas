@props(['videoId'])
<div class="aspect-video w-full overflow-hidden bg-black flex items-center justify-center relative group rounded-xl shadow-sm border border-gray-200">
    @if($videoId)
        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
    @else
        <span class="text-white font-medium">Video Tidak Tersedia</span>
    @endif
</div>
