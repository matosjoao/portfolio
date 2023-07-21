@props(['skill'])

<div class="relative pt-1 hover:opacity-80">
    <div class="flex mb-2 items-center justify-between">
        <p class="font-bold text-sm">{{$skill->language}}</p>
        <div class="text-right">
            <span class="text-sm font-semibold inline-block text-gray-700">
                {{$skill->value}}
            </span>
        </div>
    </div>
    <div class="overflow-hidden h-5 mb-4 text-xs flex bg-gray-300">
        <div style="width:{{$skill->value}}%">
            <div class="h-5 shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-700 js-scroll progress"></div>
        </div>
    </div>
</div>