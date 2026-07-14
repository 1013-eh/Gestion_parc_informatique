<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Régions et Centres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-blue-900 text-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-200">Régions</p>
                        <p class="text-2xl font-bold">{{ $regions->count() }}</p>
                    </div>
                </div>
                <div class="bg-blue-800 text-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-200">Centres</p>
                        <p class="text-2xl font-bold">{{ $centres->count() }}</p>
                    </div>
                </div>
                <div class="bg-blue-700 text-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-200">Utilisateurs</p>
                        <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
                <div class="bg-blue-600 text-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-100">Matériel</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Materiel::count() ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Tableaux côte à côte -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Régions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 pb-0">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Régions
                                <span class="ml-2 px-2 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">{{ $regions->count() }}</span>
                            </h3>
                            <a href="{{ route('regions.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium rounded transition-colors">
                                Nouvelle région
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden border-t border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                            <thead class="bg-blue-800">
                                <tr class="divide-x divide-blue-700">
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="40">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Libellé</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="80">Abrév.</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="70">Centres</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($regions as $region)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $region->libelle_region }}</td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $region->abreviation }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $region->centres_count ?? 0 }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="{{ route('regions.show', $region->id_region) }}"
                                               class="inline-flex items-center px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded transition-colors">
                                                Voir
                                            </a>
                                            <a href="{{ route('regions.edit', $region->id_region) }}"
                                               class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded transition-colors">
                                                Modifier
                                            </a>
                                            <form action="{{ route('regions.destroy', $region->id_region) }}" method="POST"
                                                  onsubmit="return confirm('Supprimer {{ $region->libelle_region }} ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition-colors">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Aucune région
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Centres -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 pb-0">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Centres
                                <span class="ml-2 px-2 py-1 text-sm bg-green-100 text-green-800 rounded-full">{{ $centres->count() }}</span>
                            </h3>
                            <a href="{{ route('centres.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium rounded transition-colors">
                                Nouveau centre
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden border-t border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                            <thead class="bg-blue-800">
                                <tr class="divide-x divide-blue-700">
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="40">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Code</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nom</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Région</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="80">Matricule</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($centres as $centre)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        <span class="text-blue-800 font-semibold">{{ $centre->code_bureau }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ Str::limit($centre->entete ?? '—', 20) }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $centre->region->libelle_region ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $centre->matricule }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="{{ route('centres.show', $centre->code_bureau) }}"
                                               class="inline-flex items-center px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded transition-colors">
                                                Voir
                                            </a>
                                            <a href="{{ route('centres.edit', ['centre' => $centre->code_bureau]) }}"
                                               class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded transition-colors">
                                                Modifier
                                            </a>
                                            <form action="{{ route('centres.destroy', $centre->code_bureau) }}" method="POST"
                                                  onsubmit="return confirm('Supprimer le centre {{ $centre->code_bureau }} ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition-colors">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Aucun centre
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>