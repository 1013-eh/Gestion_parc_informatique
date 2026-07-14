<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $region->libelle_region }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end items-center mb-6 space-x-2">
                        <a href="{{ route('regions.edit', $region->id_region) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded transition-colors">
                            Modifier
                        </a>
                        <a href="{{ route('regions.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                            Retour
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">ID</p>
                            <p class="font-medium">{{ $region->id_region }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Libellé</p>
                            <p class="font-medium">{{ $region->libelle_region }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Abréviation</p>
                            <p class="font-medium"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $region->abreviation }}</span></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Nombre de centres</p>
                            <p class="font-medium">{{ $region->centres->count() }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Centres dans cette région
                    </h3>

                    @if($region->centres->count() > 0)
                        <div class="overflow-hidden rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                                <thead class="bg-blue-800">
                                    <tr class="divide-x divide-blue-700">
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Code</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Responsable</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Adresse IP</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Type</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($region->centres as $centre)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            <a href="{{ route('centres.show', $centre->code_bureau) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $centre->code_bureau }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $centre->utilisateur->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500"><code>{{ $centre->adresse_ip }}</code></td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $centre->type_consultation_libelle ?? 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 bg-yellow-50 text-yellow-800 rounded">
                            Aucun centre dans cette région
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>