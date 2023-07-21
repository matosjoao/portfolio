@props(['name', 'id'])

<div id="{{$id}}" class="container mx-auto lg:px-32 px-10 my-28">
    <div class="flex items-center justify-center pb-10">
        <img src="{{ asset('images/title_back.png') }}" alt="title_back" width="130" class="absolute z-0">
        <h1 class="md:text-5xl text-3xl text-gray-700 py-2 mb-5 text-center roboto-bold z-10">{{ucfirst($name)}}</h1>
    </div>
    {{$slot}}
</div>