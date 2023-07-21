@props(['formation'])

<div class="h-32 mt-6 js-scroll slide-left">
    <div class="p-1 border bg-gray-700 text-white text-xs text-center inline-block">
        {{\Carbon\Carbon::parse($formation->start_datetime)->format('Y')}}  -
        {{\Carbon\Carbon::parse($formation->finish_datetime)->format('Y')}}</div>
    <div class="ml-5 mt-1">
        <p class="text-gray-800 font-bold text-base">{{$formation->title}}</p>
        <p class="text-gray-400 text-base">{{$formation->subtitle}}</p>
    </div>
</div>