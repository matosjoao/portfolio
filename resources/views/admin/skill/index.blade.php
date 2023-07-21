<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <x-card>
        <div class="flex">
            <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Skills') }}</h1>
            <div class="w-1/5">
                <x-modal :title="'Nova Skill'">
                    <x-slot name="trigger">
                        <button class="py-2 px-3 text-white rounded-lg bg-green-400 shadow-lg block md:inline-block float-right">Adicionar</button>
                    </x-slot>

                    <form id="form_skill" method="POST" action="/admin/skill">
                        @csrf
                        <!-- Title -->
                        <div>
                            <x-label for="language" class="font-bold" :value="__('Título')" />

                            <x-input id="language" class="block mt-1 w-full" type="text" name="language" :value="old('language')" required autofocus />
                        </div>
                        <!-- Subtitle -->
                        <div class="mt-5">
                            <x-label for="value" class="font-bold" :value="__('Valor')" />

                            <x-input id="value" class="block mt-1 w-full" type="number" name="value" :value="old('value')" required />
                        </div>
                        <!-- Categoria -->
                        <div class="mt-5">
                            <x-label for="skill_category_id" class="font-bold" :value="__('Categoria')" />

                            <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="skill_category_id" id="skill_category_id" required>
                                @foreach (\App\Models\SkillCategory::all() as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('skill_category_id') == $category->id ? 'selected' : '' }}
                                    >{{ ucwords($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Ordem -->
                        <div class="mt-5">
                            <x-label for="order_number" class="font-bold" :value="__('Ordem')" />

                            <x-input id="order_number" class="block mt-1 w-full" type="number" name="order_number" :value="old('order_number')"/>
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
        </div>

        <x-table>
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Título
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Valor
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ordem
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoria
                    </th>
                    <th scope="col" class="relative px-6 py-3"></th>
                    <th scope="col" class="relative px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($skills->count())
                    @foreach ($skills as $skill)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $skill->language }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $skill->value }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $skill->order_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $skill->skill_category->name }}
                            </td>
                            <td class="py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a class="text-indigo-600 hover:text-indigo-900 pr-2">Editar</a>
                            </td>
                            <td class="py-4 whitespace-nowrap text-left text-sm font-medium">
                                <form method="POST" action="/admin/skill/{{ $skill->id }}"
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
        
        {{ $skills->links() }}

    </x-card>

    <x-slot name="scripts">
        <script>
            function fillModalEdit(){
                
            }
        </script>
    </x-slot>
</x-app-layout>