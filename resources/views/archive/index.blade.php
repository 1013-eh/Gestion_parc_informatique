<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des archives') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('archive.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                    {{ __('Ajouter une archive') }}
                </a>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Num série</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date archivage</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($archives as $archive)
                            <tr>
                                <td class="px-4 py-2">{{ $archive->id_archive }}</td>
                                <td class="px-4 py-2">{{ $archive->num_serie }}</td>
                                <td class="px-4 py-2">{{ $archive->description }}</td>
                                <td class="px-4 py-2">{{ $archive->date_archivage }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('archive.edit', $archive->id_archive) }}"
                                       class="text-blue-600 hover:underline">Modifier</a>

                                    <form action="{{ route('archive.destroy', $archive->id_archive) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Supprimer cette archive ?')"
                                                class="text-red-600 hover:underline">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>