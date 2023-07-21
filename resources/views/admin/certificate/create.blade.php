<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <!-- 
        Prémios/Certificados
    -->
    <x-card>
        <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Novo Prémio/Certificado') }}</h1>

        <form method="POST" action="/admin/certificate">
            @csrf
            <!-- Title -->
            <div>
                <x-label for="title" class="font-bold" :value="__('Título')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>
            <!-- Subtitle -->
            <div class="mt-5">
                <x-label for="subtitle" class="font-bold" :value="__('Subtítulo')" />

                <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle')" required />
            </div>
            <!-- Certificated Date -->
            <div class="flex mt-5">
                <div class="w-1/2">
                    <x-label for="subtitle" class="font-bold" :value="__('Data')" />

                    <x-input id="certificated_at" class="block mt-1 w-full" type="date" name="certificated_at" :value="old('certificated_at')" required />
                </div>
                <div class="w-1/2 ml-5">
                    <x-label for="icon_name" class="font-bold" :value="__('Icon')" />

                    <x-input id="icon_name" class="block mt-1 w-full" type="text" name="icon_name" :value="old('icon_name')" required />
                </div>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <!-- Buttons -->
            <div class="text-right space-x-5 mt-5">
                <a href="/admin/certificate" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</a>
                <button type="submit" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                    Gravar
                </button>
            </div>
        </form>
    </x-card>

    <x-slot name="scripts"></x-slot>
</x-app-layout>