@props(['certificate'])

<div class="flex js-scroll slide-right">
    <div class="w-1/6 flex items-center justify-center text-5xl">
        <i class="fa {{$certificate->icon_name}} text-gray-700" aria-hidden="true"></i>
    </div>
    <div class="w-5/6 relative pt-1 pl-2">
        <p class="font-bold text-sm">
            {{\Carbon\Carbon::parse($certificate->certificated_at)->format('m/Y')}}
            -
            {{$certificate->title}}
        </p>
        <p class="text-gray-400 text-base">{{$certificate->subtitle}}</p>
    </div>
</div>