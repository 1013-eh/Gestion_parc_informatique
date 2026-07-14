<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des centres') }}
            <span class="ml-2 px-2 py-1 text-sm bg-green-100 text-green-800 rounded-full">
                {{ $centres->count() }}
            </span>
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

                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('centres.create') }}"
                       class="inline-block px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                        {{ __('Nouveau centre') }}
                    </a>
                </div>

                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                    <div>
                        <select name="region" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Toutes les régions</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id_region }}" {{ request('region') == $region->id_region ? 'selected' : '' }}>
                                    {{ $region->libelle_region }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <select name="type" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Tous les types</option>
                            <option value="GLOBAL" {{ request('type') == 'GLOBAL' ? 'selected' : '' }}>Global</option>
                            <option value="PAR_CENTRE" {{ request('type') == 'PAR_CENTRE' ? 'selected' : '' }}>Par centre</option>
                            <option value="ADMIN" {{ request('type') == 'ADMIN' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div>
                        <input
                            type="text"
                            name="search"
                            class="w-full border-gray-300 rounded-md text-sm"
                            placeholder="Rechercher par code, nom ou IP..."
                            value="{{ request('search') }}"
                        />
                    </div>

                    <div>
                        <a href="{{ route('centres.index') }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                            Réinitialiser
                        </a>
                    </div>
                </form>

                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" style="width:60px">#</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nom du centre</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Région</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Matricule</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Adresse IP</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider" style="width:160px">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($centres as $centre)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <strong class="text-blue-800">{{ $centre->code_bureau }}</strong>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $centre->nom_centre ?? '—' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $centre->region->libelle_region ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $centre->matricule }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><code>{{ $centre->adresse_ip }}</code></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $centre->type_consultation_libelle ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <div class="flex justify-center items-center space-x-3">
                                            @if(auth()->check() && ((auth()->user()->matricule ?? null) == 1))
                                                <a href="{{ route('centres.edit', $centre->code_bureau) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                                    Modifier
                                                </a>

                                                <form action="{{ route('centres.destroy', $centre->code_bureau) }}" method="POST"
                                                      onsubmit="return confirm('Supprimer ce centre définitivement ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition-colors">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                                        <div class="font-medium text-gray-700 mb-2">Aucun centre trouvé</div>
                                        <a href="{{ route('centres.create') }}"
                                           class="inline-block px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                                            Créer le premier centre
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $centres->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>