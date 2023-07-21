@props(['hobbie'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center hover:opacity-80 text_center']) }}>
    <div class="div-svg flex w-14 h-14 rounded-full bg-gray-700 px-3 py-3">
        {!! $hobbie->image_svg !!}
    </div>
    <h1 class="font-bold text-sm mt-1">{{ $hobbie->title }}</h1>
</div>
