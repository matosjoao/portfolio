<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <!-- 
        Hobbies
    -->
    <x-card>
        <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Editar Hobbie') }}</h1>

        <form method="POST" action="/admin/hobbie/{{ $hobbie->id }}">
            @csrf
            @method('PATCH')

            <!-- Title -->
            <div>
                <x-label for="title" class="font-bold" :value="__('Título')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $hobbie->title)" required autofocus />
            </div>
            <!-- Subtitle -->
            <div class="mt-5">
                <x-label for="subtitle" class="font-bold" :value="__('Subtítulo')" />

                <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle', $hobbie->subtitle)" />
            </div>
            <!-- Description -->
            <div class="mt-5">
                <x-label for="image_svg" class="font-bold" :value="__('Descrição')" />

                <textarea id="image_svg" name="image_svg" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                    {{ old('image_svg', $hobbie->image_svg) }}
                </textarea>
            </div>
            <!-- Ordem -->
            <div>
                <x-label for="order_number" class="font-bold" :value="__('Ordem')" />

                <x-input id="order_number" class="block mt-1 w-full" type="number" name="order_number" :value="old('order_number', $hobbie->order_number)" required autofocus />
            </div>
            

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <!-- Buttons -->
            <div class="text-right space-x-5 mt-5">
                <a href="/admin/hobbie" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</a>
                <button type="submit" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                    Gravar
                </button>
            </div>
        </form>
    </x-card>

    <x-slot name="scripts"></x-slot>
</x-app-layout>