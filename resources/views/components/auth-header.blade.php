@props(['title', 'description'])

<div class="flex flex-col items-start gap-1">
    <h1 class="text-2xl font-bold tracking-tight text-black">{{ $title }}</h1>
    <p class="text-base text-gray-800">{{ $description }}</p>
</div>
