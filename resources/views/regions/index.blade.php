<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des régions') }}
            <span class="ml-2 px-2 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">{{ $regions->count() }}</span>
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

                @if($isAdmin)
                <div class="flex justify-end mb-4">
                    <a href="{{ route('regions.create') }}"
                        class="inline-block px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                        {{ __('Nouvelle région') }}
                    </a>
                </div>
                @endif

                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Libellé</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Abréviation</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Centres</th>
                                @if($isAdmin)<th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Actions</th>@endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($regions as $region)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $region->libelle_region }}</td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $region->abreviation }}</span>
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $region->centres_count ?? 0 }}</span>
                                </td>
                                @if($isAdmin)
                                <td class="px-6 py-4 text-center text-sm">
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('regions.edit', $region->id_region) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                            Modifier
                                        </a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Aucune région trouvée
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
