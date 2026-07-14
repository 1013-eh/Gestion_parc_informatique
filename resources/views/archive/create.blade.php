<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choisir un matériel à archiver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="GET" action="{{ route('archive.create') }}" class="flex gap-2 mb-6">
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Rechercher par N° série"
                           class="w-64 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                        Rechercher
                    </button>
                    @if($search)
                        <a href="{{ route('archive.create') }}"
                           class="px-4 py-2 text-gray-600 hover:underline">
                            Réinitialiser
                        </a>
                    @endif
                </form>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="p-3 text-left border-r border-blue-800">N° Série</th>
                                <th class="p-3 text-left border-r border-blue-800">Marque</th>
                                <th class="p-3 text-left border-r border-blue-800">Modèle</th>
                                <th class="p-3 text-left border-r border-blue-800">État</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($materiels as $materiel)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-3 border-r">{{ $materiel->num_serie }}</td>
                                    <td class="p-3 border-r">{{ $materiel->modele?->marque?->nom_marque ?? 'N/A' }}</td>
                                    <td class="p-3 border-r">{{ $materiel->modele?->nom_modele ?? 'N/A' }}</td>
                                    <td class="p-3 border-r">{{ $materiel->etat }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('archive.createForm', $materiel->num_serie) }}"
                                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Choisir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-gray-500">
                                        Aucun matériel hors usage trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pt-4">
                    <a href="{{ route('archive.index') }}" class="text-gray-600 hover:underline">
                        {{ __('Retour à la liste') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>