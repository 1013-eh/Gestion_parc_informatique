<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matériels') }}
        </h2>
        <a href="{{ route('materiels.create') }}">
            <x-primary-button>
                {{ __('Ajouter +') }}
            </x-primary-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">N° Série</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Sous-Famille</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Bureau</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Marque</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Modèle</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">CAB</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Marché</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Date Affect.</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">N° Ordre</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Machine</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">État</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($materiels as $m)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $m->num_serie }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->sousFamille?->nom_sous_famille ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->code_bureau }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->marque }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->modele }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->cab }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->num_marche }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->date_affectation }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->num_ordre }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $m->machine }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap"> 
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $m->etat === 'BON' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $m->etat === 'EN_PANNE' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $m->etat === 'HORS_USAGE' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $m->etat === 'ARCHIVE' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ $m->etat }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="#" class="inline-flex items-center px-2.5 py-1.5 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600">
                                                    Modifier
                                                </a>
                                                <!-- <form method="POST" action="#" onsubmit="return confirm('Confirmer la suppression ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">
                                                        Supprimer
                                                    </button>
                                                </form> -->
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="px-4 py-8 text-center text-gray-500">
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
    </div>
</x-app-layout>
