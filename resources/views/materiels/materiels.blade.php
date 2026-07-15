<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matériels') }}
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

                @if(session('warning'))
                    <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded">
                        {!! session('warning') !!}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {!! session('error') !!}
                    </div>
                @endif

                <div class="mb-4 flex gap-2">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('materiels.create') }}"
                        class="inline-block px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                           {{ __('Ajouter un matériel') }}
                        </a>
                    @endif
                    <a href="{{ route('materiels.export') }}"
                    class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">
                        Exporter (Excel)
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('materiels.import.form') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
                           Importer (Excel)
                        </a>
                    @endif
                </div>

                <div class="overflow-hidden rounded-lg border border-gray-200 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">N° Série</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Sous-Famille</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Bureau</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Centre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Marque</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Modèle</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">CAB</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Marché</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Date Affect.</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">N° Ordre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Machine</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">État</th>
                                @if(auth()->user()->isAdmin())
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($materiels as $m)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $m->num_serie }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->marque?->sousFamille?->nom_sous_famille ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->code_bureau }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->centre?->nom_centre ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->marque?->nom_marque ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->nom_modele ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->cab }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->num_marche }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $m->date_affectation }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->num_ordre }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->machine }}</td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $m->etat === 'BON' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $m->etat === 'EN_PANNE' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $m->etat === 'HORS_USAGE' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $m->etat === 'ARCHIVE' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ $m->etat }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->isAdmin())
                                        <td class="px-4 py-4 text-sm text-center whitespace-nowrap">
                                           <a href="{{ route('materiels.edit', $m->num_serie) }}"
                                              class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                               Modifier
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->isAdmin() ? 13 : 12 }}" class="px-4 py-8 text-center text-gray-500">
                                        Aucun matériel trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>