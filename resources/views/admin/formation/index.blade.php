<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <x-card>
        <div class="flex">
            <h1 class="font-bold text-lg pb-10 w-4/5">{{ __('Educação e Formação') }}</h1>
            <div class="w-1/5">
                <a href="/admin/formation/create" class="py-2 px-3 text-white rounded-lg bg-green-400 shadow-lg block md:inline-block float-right">Adicionar</a>
            </div>
        </div>

        <x-table>
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Título/Subtítulo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data Início
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data Fim
                    </th>
                    <th scope="col" class="relative px-6 py-3"></th>
                    <th scope="col" class="relative px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($formations->count())
                    @foreach ($formations as $formation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $formation->title }}</div>
                                <div class="text-sm text-gray-500">{{ $formation->subtitle }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($formation->start_datetime)->format('Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($formation->is_current)
                                    Currente
                                @else
                                    {{ \Carbon\Carbon::parse($formation->finish_datetime)->format('Y') }}
                                @endif
                            </td>
                            <td class="py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="/admin/formation/{{ $formation->id }}/edit" class="text-indigo-600 hover:text-indigo-900 pr-2">Editar</a>
                            </td>
                            <td class="py-4 whitespace-nowrap text-left text-sm font-medium">
                                <form method="POST" action="/admin/formation/{{ $formation->id }}"
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
                     <td class="py-4 whitespace-nowrap text-center text-sm font-medium" colspan="5">
                        Sem registo de dados.
                    </td>
                @endif
            </tbody>
        </x-table>
        
        {{ $formations->links() }}

    </x-card>

    <x-slot name="scripts"></x-slot>
</x-app-layout>