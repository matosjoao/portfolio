@props(['spokenLanguage'])

<div {{ $attributes->merge(['class' => 'flex hover:opacity-80']) }}">
    <h1 class="w-1/3 font-bold text-sm">{{$spokenLanguage->language}}</h1>
    <div class="flex justify-end w-2/3">
        @for ($i = 0; $i < 6; $i++)
            @if($i < $spokenLanguage->value)
            <div class="w-6 h-5 ml-1 bg-gray-700 js-scroll-lang"></div>
            @else
            <div class="w-6 h-5 ml-1 bg-gray-300 js-scroll-lang"></div>
            @endif
        @endfor
    </div>
</div>
