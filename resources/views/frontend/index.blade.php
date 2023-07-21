<x-guest-layout>
    <div class="flex flex-col bg-gray-700 h-screen wrapper">
        <div class="flex justify-center items-center py-6 sm:justify-end sm:space-x-10 px-4">
            <nav class="hidden sm:flex sm:space-x-10">
                <a href="#about_me" class="text-lg font-medium text-white hover:underline roboto-thin">
                    About me
                </a>
                <a href="#resume" class="text-lg font-medium text-white hover:underline roboto-thin">
                    Resume
                </a>
                <a href="#portfolio" class="text-lg font-medium text-white hover:underline roboto-thin">
                    Portfolio
                </a>
                <a href="#contact_me" class="text-lg font-medium text-white hover:underline roboto-thin">
                    Contacts
                </a>
            </nav>
        </div>
        <div class="flex flex-1 flex-col md:flex-row">

            <div class="flex flex-col flex-1 items-center">
                <div class="flex flex-col flex-1 md:mt-20 ">
                    <h1 class="lg:text-9xl md:text-8xl sm:text-9xl text-8xl text-white roboto-bold text-effect">Hi,</h1>
                    <h1 class="lg:text-8xl md:text-7xl sm:text-9xl text-7xl text-gray-500 roboto-bold mt-12">I'm João!</h1>
                    <h1 class="lg:text-4xl md:text-2xl sm:text-4xl text-3xl text-gray-200 roboto-bold self-center mt-5">Web/Mobile Developer!</h1>
                </div>
                <div class="z-10 flex-1 mt-20">
                    <a href="#contact_me" class="hover:bg-gray-600 border-white border-2 border-opacity-80 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 uppercase" type="button">
                        Hire me now!
                    </a>
                </div>
            </div>
            <div class="flex flex-1 justify-start items-end">
               <!--  <img src="storage/person.png" alt="user image" /> -->
            </div>

            <!-- 
            <div class="container mx-auto sm:mt-10 mt-5 px-10">
                <div class="flex sm:flex-row flex-col justify-center">
                    <div class="flex flex-col ml-10">
                        <h1 class="sm:text-9xl text-7xl -ml-12 text-white roboto-bold text-effect mb-10">Hi,</h1>
                        <h1 class="sm:text-8xl text-7xl text-gray-500 roboto-bold">I'm João!</h1>
                        <h1 class="sm:text-3xl text-2xl text-gray-200 ml-1.5 py-2 roboto-bold">Web/Mobile Developer!</h1>
                    </div>
                </div>
            </div>

            @if ($settings->profile_image)
                <div class="z-10 flex flex-col py-10 justify-center items-center">
                    <img class="rounded-full shadow-sm" width="250" src="storage/{{$settings->profile_image}}" alt="user image" />
                </div>
            @endif

            <div class="z-10 flex sm:flex-row flex-col pb-20 sm:justify-between justify-center items-center">
                <div class="mb-2">
                    <a href="#contact_me" class=" hover:bg-gray-600 border-white border-2 border-opacity-80 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 sm:ml-20 uppercase" type="button">
                        Hire me now!
                    </a>
                </div>
                <div class="mx-10">
                    <p class="text-white text-sm roboto-thin text-center">{!! $settings->motivational_phrase !!}</p>
                </div>
            </div> 
            -->
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <x-frontend.main-container :name="'About me'" :id="'about_me'">
        <div class="flex text-2xl bg-gray-700 p-14 text-white js-scroll fade-in-top">
            {!! $settings->about_me !!}
        </div>
    </x-frontend.main-container>

    <x-frontend.main-container :name="'Resume'" :id="'resume'">
        <div class="flex flex-col md:flex-row">

            <div class="flex md:w-3/5">
                <div class="timeline-lines">
                    <x-frontend.experience-dot-header :icon="'fa-handshake-o'" />
                    @foreach ($professional_experiences as $experience)
                    <x-frontend.experience-dot :active="$experience->is_current" />
                    @endforeach

                    <x-frontend.experience-dot-header :icon="'fa-graduation-cap'" />
                    @foreach ($formations as $formation)
                    <x-frontend.experience-dot :active="$formation->is_current || $loop->first" />
                    @endforeach
                    <div class="line bg-gray-300 h-12"></div>
                </div>
                <div class="ml-5">
                    <!--
                        Work Experience
                    -->
                    <div class="flex items-center font-bold text-xl" style="height:60px">
                        Professional Experience
                    </div>
                    @foreach ($professional_experiences as $experience)
                    <x-frontend.experience-item :experience="$experience" />
                    @endforeach

                    <!-- 
                        Education
                    -->
                    <div class="flex items-center font-bold text-xl" style="height:70px">
                        Education and Training
                    </div>
                    @foreach ($formations as $formation)
                    <x-frontend.formation-item :formation="$formation" />
                    @endforeach
                </div>
            </div>

            <!--
                Others
            -->
            <div class="md:w-2/5">
                <div class="ml-10 ">
                    <div class="font-bold text-xl mt-4 mb-4">
                        Skills
                    </div>
                    @foreach ($skills as $skill)
                    <x-frontend.skill-item :skill="$skill" />
                    @endforeach

                    <x-frontend.divider />

                    <div class="font-bold text-xl mb-4">
                        Awards/Certificates
                    </div>
                    @foreach ($certificates as $certificate)
                    <x-frontend.certificate-item :certificate="$certificate" />
                    @endforeach

                    <x-frontend.divider />

                    <div class="font-bold text-xl mb-4">
                        Languages
                    </div>
                    <div class="flex flex-col">
                        @foreach ($spoken_languages as $spoken_language)
                        <x-frontend.spoken-language-item :spokenLanguage="$spoken_language" class="{{ !$loop->first ? 'mt-5' : null}}" />
                        @endforeach
                    </div>

                    <x-frontend.divider />

                    <div class="font-bold text-xl mb-4">
                        Hobbies
                    </div>
                    <div class="flex js-scroll slide-right">
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ($hobbies as $hobbie)
                                <x-frontend.hobbie-item :hobbie="$hobbie" class="{{ !$loop->first ? 'ml-5' : null}}" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#contact_me" class="shadow bg-gray-700 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 ml-10 mt-10 md:mt-0">
            Request CV
        </a>
    </x-frontend.main-container>


    <!--
        Portfolio
    -->
    <x-frontend.main-container :name="'Portfolio'" :id="'portfolio'">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @foreach ($projects as $project)
                <x-frontend.project-item :project="$project" />
            @endforeach
        </div>
    </x-frontend.main-container>

    <!--
        Contact me
    -->
    <x-frontend.main-container :name="'Let\'s work together?'" :id="'contact_me'">
        <x-frontend.contact-form />
    </x-frontend.main-container>

    <!--
        Scroll Top Button
    -->
    <a id="scrollToTop" class="scrollToTop bg-gray-700 rounded-full text-white p-2 h-10 w-10 text-center shadow-md" href="javascript:scrollToTop();">
        <i class="fa fa-chevron-up" aria-hidden="true"></i>
    </a>

    <!--
        Footer
    -->
    <div class="md:-mt-52 -mt-32" >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="rgba(55, 65, 81,1)" fill-opacity="1" d="M0,288L1440,192L1440,320L0,320Z"></path>
        </svg>
        <div class="py-12 px-4 bg-gray-700 ">
            <div aria-label="footer" class="focus:outline-none mx-auto container flex flex-col items-center justify-center">
                <div class="text-white flex flex-col md:items-center f-f-l pt-3">
                    <ul class="flex items-center justify-center ">
                        <li class="mr-6 cursor-pointer pt-4 lg:py-0 border-b-2"><a href="#about_me" class="focus:outline-none focus:underline hover:text-gray-500"> About me</a></li>
                        <li class="mr-6 cursor-pointer pt-4 lg:py-0 border-b-2"><a href="#resume" class="focus:outline-none focus:underline hover:text-gray-500"> Resume</a></li>
                        <li class="mr-6 cursor-pointer pt-4 lg:py-0 border-b-2"><a href="#portfolio" class="focus:outline-none focus:underline hover:text-gray-500"> Portfolio</a></li>
                        <li class="mr-6 cursor-pointer pt-4 lg:py-0 border-b-2"><a href="#contact_me" class="focus:outline-none focus:underline hover:text-gray-500"> Contacts</a></li>
                    </ul>
                    <h1 class="focus:outline-none text-xs font-black text-center"></h1>
                    <div class="my-6 text-base text-color f-f-l">
                        <ul class="flex items-center justify-center">
                            @foreach ($contacts as $contact)
                                <li class="mr-6 cursor-pointer pt-4 lg:py-0">
                                    <a href="{{$contact->description}}" target="_blank" class="focus:outline-none focus:underline hover:text-gray-500">
                                        <i class="{{$contact->icon_name}}" aria-hidden="true"></i> 
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="text-sm text-color mb-10 f-f-l flex items-center justify-center">
                        <p class="focus:outline-none">© {{ now()->year }} João Matos. All rights reserved.</p>
                    </div>
                </div>
                <div class="w-9/12 h-0.5 bg-gray-100 rounded-full"></div>
            </div>
        </div>
    </div>

</x-guest-layout>