@props(['experience'])

<div class="h-32 mt-6 js-scroll slide-left">
    <div class="p-1 border bg-gray-700 text-white text-xs text-center inline-block">
        {{\Carbon\Carbon::parse($experience->start_datetime)->format('F Y')}} 
        -
        @if ($experience->is_current == 1)
            Current
        @else
            {{\Carbon\Carbon::parse($experience->finish_datetime)->format('F Y')}} 
        @endif
    </div>
    <div class="ml-5 mt-1">
        <p class="text-gray-800 font-bold text-base">{{$experience->title}}</p>
        <p class="text-gray-400 text-base">{{$experience->subtitle}}</p>
        <p class="text-gray-700 text-xs hidden md:inline-block lg:text-sm">{!!$experience->description!!}</p>
    </div>
</div>