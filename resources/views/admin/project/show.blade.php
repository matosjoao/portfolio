@section('css')
<style>
    .hasImage:hover section {
        background-color: rgba(5, 5, 5, 0.4);
    }

    .hasImage:hover button:hover {
        background: rgba(5, 5, 5, 0.45);
    }

    #overlay p,
    i {
        opacity: 0;
    }

    #overlay.draggedover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    #overlay.draggedover p,
    #overlay.draggedover i {
        opacity: 1;
    }

    .group:hover .group-hover\:text-blue-800 {
        color: #2b6cb0;
    }
</style>
@stop

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio') }}
        </h2>
    </x-slot>

    <!-- 
        Portfolio
    -->
    <x-card>
        
        <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Projeto') }} {{ $project->title }}</h1>

        <div class="w-full mt-5">
            <label class="text-md font-bold">Subtítulo</label>
            <p class="text-sm">{{ $project->subtitle ?? '-' }}</p>
        </div>

        <div class="w-full mt-5">
            <label class="text-md font-bold">Descrição</label>
            <p class="text-sm">{!! $project->description ?? '-' !!}</p>
        </div>

        <!-- Images -->
        <div class="w-full mt-10">
            
            <div class="flex flex-row mb-10">
            @foreach ($project->project_image as $image)
                <div class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                    <form method="POST" action="/admin/projectImage/{{ $image->id }}"
                    x-data
                    onclick="return confirm('Têm a certeza que pretende apagar este registo?')"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                    </form>

                    <img class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" src="/storage/{{$image->path}}" alt="" />
                </div>
            @endforeach
            </div>

            <form>
                <label class="text-md font-bold">Imagens: </label>
                <input type="hidden" id="project_id" value="{{$project->id}}"/>
                @csrf
                <article aria-label="File Upload Modal" class="relative h-full flex flex-col " ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">
                    <div id="overlay" class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                        <i>
                            <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                            </svg>
                        </i>
                        <p class="text-lg text-blue-700">Solte as imagens para carregar</p>
                    </div>

                    <section class="overflow-auto p-8 w-full h-full flex flex-col">
                        <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                            <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                <span>Arraste e solte as </span>&nbsp;<span>imagens ou</span>
                            </p>
                            <input id="project_images" name="project_images[]" type="file" multiple class="hidden" />
                            <button id="button_project_images" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                Carregue uma imagem
                            </button>
                        </header>

                        <ul id="gallery" class="flex flex-1 flex-wrap -m-1 pt-8">
                            <li id="empty" class="h-full w-full text-center flex flex-col justify-center items-center">
                            <img class="mx-auto w-32" src="{{ asset('images/upload_empty.png') }}" alt="no data" />
                                <span class="text-small text-gray-500">Sem ficheiros seleccionados</span>
                            </li>
                        </ul>

                        <!-- sticky footer -->
                        <footer class="flex justify-end px-8 pb-8 pt-4">
                            <button id="submit" class="rounded-sm px-3 py-1 bg-gray-700 hover:bg-gray-500 text-white focus:shadow-outline focus:outline-none">
                                Carregar
                            </button>
                        </footer>
                    </section>
                </article> 

                <x-files.file />
                <x-files.image />

            </form>
        </div>
        <!-- Buttons -->
        <div class="text-right space-x-5 mt-5">
            <a href="/admin/project" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</a>
        </div>
    </x-card>

    <x-slot name="scripts">
        <script>
            const fileTempl = document.getElementById("file-template"),
                imageTempl = document.getElementById("image-template"),
                empty = document.getElementById("empty");

            // use to store pre selected files
            let FILES = {};
            //let VIDEOS = {};

            // check if file is of type image and prepend the initialied
            // template to the target element
            function addFile(target, file) {
                const isImage = file.type.match("image.*"),
                    objectURL = URL.createObjectURL(file);
                
                //const isVideo = file.type.match("video.*");

                const clone = isImage ?
                    imageTempl.content.cloneNode(true) :
                    fileTempl.content.cloneNode(true);

                clone.querySelector("h1").textContent = file.name;
                clone.querySelector("li").id = objectURL;
                clone.querySelector(".delete").dataset.target = objectURL;
                clone.querySelector(".size").textContent =
                    file.size > 1024 ?
                    file.size > 1048576 ?
                    Math.round(file.size / 1048576) + "mb" :
                    Math.round(file.size / 1024) + "kb" :
                    file.size + "b";

                isImage &&
                    Object.assign(clone.querySelector("img"), {
                        src: objectURL,
                        alt: file.name
                    });

                empty.classList.add("hidden");
                target.prepend(clone);
                FILES[objectURL] = file;
                /* if(isVideo)
                {
                    VIDEOS[objectURL] = file;
                }
                else
                {
                    FILES[objectURL] = file;
                } */
            }

            const gallery = document.getElementById("gallery"),
                overlay = document.getElementById("overlay");

            // click the hidden input of type file if the visible button is clicked
            // and capture the selected files
            const hidden = document.getElementById("project_images");
            document.getElementById("button_project_images").onclick = (e) => {
                e.preventDefault();
                hidden.click();
            };
            hidden.onchange = (e) => {
                for (const file of e.target.files) {
                    addFile(gallery, file);
                }
            };

            // use to check if a file is being dragged
            const hasFiles = ({
                    dataTransfer: {
                        types = []
                    }
                }) =>
                types.indexOf("Files") > -1;

            // use to drag dragenter and dragleave events.
            // this is to know if the outermost parent is dragged over
            // without issues due to drag events on its children
            let counter = 0;

            // reset counter and append file to gallery when file is dropped
            function dropHandler(ev) {
                ev.preventDefault();
                for (const file of ev.dataTransfer.files) {
                    addFile(gallery, file);
                    overlay.classList.remove("draggedover");
                    counter = 0;
                }
            }

            // only react to actual files being dragged
            function dragEnterHandler(e) {
                e.preventDefault();
                if (!hasFiles(e)) {
                    return;
                }
                ++counter && overlay.classList.add("draggedover");
            }

            function dragLeaveHandler(e) {
                1 > --counter && overlay.classList.remove("draggedover");
            }

            function dragOverHandler(e) {
                if (hasFiles(e)) {
                    e.preventDefault();
                }
            }

            // event delegation to caputre delete events
            // fron the waste buckets in the file preview cards
            gallery.onclick = ({
                target
            }) => {
                if (target.classList.contains("delete")) {
                    const ou = target.dataset.target;
                    document.getElementById(ou).remove(ou);
                    gallery.children.length === 1 && empty.classList.remove("hidden");
                    delete FILES[ou];
                }
            };

            // print all selected files
            document.getElementById("submit").onclick = (e) => {
                e.preventDefault();

                let formData = new FormData();
                for (let objectURL in FILES) {
                    formData.append('files[]', FILES[objectURL]);
                }
                /* for (let objectURL in VIDEOS) {
                    formData.append('videos[]', VIDEOS[objectURL]);
                } */
                formData.append('project_id', document.getElementById('project_id').value);

                axios.defaults.headers.post['X-CSRF-Token'] = document.querySelector('[name="_token"]').value;
                axios.post("{{route('projectImage.store')}}", formData)
                .then(function (response) {
                    alert(response.data);
                    window.location.reload();
                })
                .catch(function (error) {
                    alert(error.message);
                }); 
            };

            // clear entire selection
            /* document.getElementById("cancel").onclick = () => {
                while (gallery.children.length > 0) {
                    gallery.lastChild.remove();
                }
                FILES = {};
                empty.classList.remove("hidden");
                gallery.append(empty);
            }; */ 
        </script>
    </x-slot>
</x-app-layout>