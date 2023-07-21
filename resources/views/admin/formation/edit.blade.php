<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <!-- 
        Experiência Profissional
    -->
    <x-card>
        <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Editar Educação e Formação') }}</h1>

        <form method="POST" action="/admin/formation/{{ $formation->id }}">
            @csrf
            @method('PATCH')

            <!-- Title -->
            <div>
                <x-label for="title" class="font-bold" :value="__('Título')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $formation->title)" required autofocus />
            </div>
            <!-- Subtitle -->
            <div class="mt-5">
                <x-label for="subtitle" class="font-bold" :value="__('Subtítulo')" />

                <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle', $formation->subtitle)" required />
            </div>
            <!-- Description -->
            <div class="mt-5">
                <x-label for="description" class="font-bold" :value="__('Descrição')" />

                <textarea id="description" name="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                    {{ old('description', $formation->description) }}
                </textarea>
            </div>
            <!-- Dates -->
            <div class="flex mt-5">
                <div class="w-1/2">
                    <x-label for="subtitle" class="font-bold" :value="__('Data Início')" />

                    <x-input id="start_datetime" class="block mt-1 w-full" type="date" name="start_datetime" :value="old('start_datetime', $formation->start_datetime)" required />
                </div>
                <div class="w-1/2 ml-5">
                    <x-label for="subtitle" class="font-bold" :value="__('Data Fim')" />

                    <x-input id="finish_datetime" class="block mt-1 w-full" type="date" name="finish_datetime" :value="old('finish_datetime', $formation->finish_datetime)"/>
                </div>
            </div>
            <div class="flex py-5 justify-end">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="is_current" name="is_current" class="form-checkbox" {{ $formation->is_current ? 'checked' : '' }}>
                    <span class="ml-2">Currente?</span>
                </label>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <!-- Buttons -->
            <div class="text-right space-x-5 mt-5">
                <a href="/admin/formation" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</a>
                <button type="submit" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                    Gravar
                </button>
            </div>
        </form>
    </x-card>

    <x-slot name="scripts"></x-slot>
</x-app-layout>