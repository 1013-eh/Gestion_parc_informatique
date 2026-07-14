<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centre') }} : {{ $centre->code_bureau }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end items-center mb-6 space-x-2">
                        <a href="{{ route('centres.edit', $centre->code_bureau) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded transition-colors">
                            Modifier
                        </a>
                        <a href="{{ route('centres.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                            Retour
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Code bureau</p>
                            <p class="font-medium">{{ $centre->code_bureau }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Nom du centre</p>
                            <p class="font-medium">{{ $centre->nom_centre ?? '—' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Région</p>
                            <p class="font-medium"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $centre->region->libelle_region ?? 'N/A' }}</span></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Matricule</p>
                            <p class="font-medium"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $centre->matricule }}</span></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Adresse IP</p>
                            <p class="font-medium"><code>{{ $centre->adresse_ip }}</code></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Type de consultation</p>
                            <p class="font-medium"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $centre->type_consultation_libelle ?? 'N/A' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>