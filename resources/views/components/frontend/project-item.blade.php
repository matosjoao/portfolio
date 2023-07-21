@props(['project'])

@if ($project->highlighted)
<div class="m-10 md:m-5 md:col-span-2 bg-gray-700 transform hover:-translate-y-1 hover:scale-105">
@else   
<div class="m-10 md:m-5 bg-gray-700 transform hover:-translate-y-1 hover:scale-110">
@endif
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 bg-gray-700">

        @if ($project->project_image->count() > 0)
            @if ($project->project_image->count() == 1)
                @if ($project->project_image->first()?->is_image == 1)
                    <img alt="" src="storage/{{ $project->project_image->first()?->path }}" class="w-full object-contain max-h-80 align-middle">
                @else   
                    <video class="w-full h-96 z-50" controls muted>
                        <source src="storage/{{ $project->project_image->first()?->path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video> 
                @endif
            @else   
                <div class="w-full max-h-80 flex flex-col justify-center items-center" x-data="{ activeSlide: 0, slides: {{ $project->project_image }} }">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="slide.id">
                        <img x-show="activeSlide === index" alt="" :src="'storage/' + slide.path" class="w-full object-contain max-h-80 align-middle">
                    </template>
                    
                    <!-- Prev/Next Arrows -->
                    <div class="absolute inset-0 flex" style="margin-top: 25%">
                        <div class="flex justify-start w-1/2">
                            <button  class="w-8 h-8 ml-2 mt-2 text-lg text-white bg-gray-500 rounded-full" x-on:click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i> 
                            </button>
                        </div>
                        <div class="flex justify-end w-1/2">
                            <button class="w-8 h-8 mr-2 mt-2 text-lg text-white bg-gray-500 rounded-full" x-on:click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i> 
                            </button>
                        </div>        
                    </div>

                </div>
            @endif
        @endif
        
        <blockquote class="relative p-8 mb-4">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height:95px;top:-94px">
                <polygon points="-30,95 583,95 583,65" class="text-gray-700 fill-current"></polygon>
            </svg>
            <h4 class="text-xl font-bold text-white">{{ $project->title }}</h4>
            @if ($project->description)
                <p class="text-md font-light mt-2 text-white roboto-thin">{!!$project->description!!}</p>
            @endif
        </blockquote>
    </div>
</div>