<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin.base_settings') }}
        </h2>
    </x-slot>

    <x-card>
        <div class="flex flex-col">
            <form class="flex flex-col" method="POST" action="/admin/base_settings/1" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- About me -->
                <div class="mt-5">
                    <x-label for="about_me" class="font-bold" :value="__('About me')" />
                    <textarea id="about_me" name="about_me" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" rows="8" required>{{ old('about_me', $settings->about_me) }}</textarea>
                </div>

                <!-- Frase motivacional -->
                <div class="mt-5">
                    <x-label for="motivational_phrase" class="font-bold" :value="__('Frase motivacional')" />
                    <textarea id="motivational_phrase" name="motivational_phrase" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" rows="8" required>{{ old('motivational_phrase', $settings->motivational_phrase) }}</textarea>
                </div>

                <!-- Foto -->
                <div class="flex mt-5 items-center">
                    @if ($settings->profile_image)
                        <div class="flex py-10 justify-center items-center mr-20">
                            <img class="rounded-full shadow-sm" width="200" src="/storage/{{$settings->profile_image}}" alt="user image" />
                        </div>
                    @endif
                    <div>
                        <x-label for="profile_image" class="font-bold" :value="__('Foto')" />
                        <x-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" :value="old('profile_image', $settings->profile_image)"/>
                    </div>
                </div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                
                <!-- Buttons -->
                <div class="text-right space-x-5 mt-5">
                    <button type="submit" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                        Gravar
                    </button>
                </div>
            </form>
        </div>
    </x-card>

    <x-card>
        <div class="flex flex-col">
            <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Contactos') }}</h1>
        
            <div class="pb-10">
                <x-modal :title="'Novo Contacto'">
                    <x-slot name="trigger">
                        <button class="py-2 px-3 text-white rounded-lg bg-green-400 shadow-lg block md:inline-block float-right">Adicionar</button>
                    </x-slot>

                    <form id="form_skill" method="POST" action="/admin/contact">
                        @csrf
                        <!-- Title -->
                        <div>
                            <x-label for="name" class="font-bold" :value="__('Nome')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                        <!-- Description -->
                        <div class="mt-5">
                            <x-label for="description" class="font-bold" :value="__('Link')" />

                            <textarea id="description" name="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" rows="4" required>{{ old('description') }}</textarea>
                        </div>
                        <!-- Icon -->
                        <div class="mt-5">
                            <x-label for="icon_name" class="font-bold" :value="__('Icon')" />

                            <x-input id="icon_name" class="block mt-1 w-full" type="text" name="icon_name" :value="old('icon_name')" required/>
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        <!-- Buttons -->
                        <div class="text-right space-x-5 mt-5">
                            <button type="button" @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</button>
                            <button type="submit" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                                Gravar
                            </button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <x-table>
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descrição
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Icon
                        </th>
                        <th scope="col" class="relative px-6 py-3"></th>
                        <th scope="col" class="relative px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($contacts->count())
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $contact->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <i class="{{ $contact->icon_name }}" aria-hidden="true"></i>
                                </td>
                                <td class="py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a class="text-indigo-600 hover:text-indigo-900 pr-2">Editar</a>
                                </td>
                                <td class="py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <form method="POST" action="/admin/contact/{{ $contact->id }}"
                                    x-data
                                    onclick="return confirm('Têm a certeza que pretende apagar este registo?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td class="py-4 whitespace-nowrap text-center text-sm font-medium" colspan="4">
                            Sem registo de dados.
                        </td>
                    @endif
                </tbody>
            </x-table>
            
            {{ $contacts->links() }}
        </div>
    </x-card>

    <x-slot name="scripts"></x-slot>
</x-app-layout>