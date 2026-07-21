<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matériels') }}
            <span class="ml-2 px-2 py-1 text-sm bg-green-100 text-green-800 rounded-full">
                {{ $nbrMateriels}}
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

                <form method="GET" class="mb-4" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
                    <div style="flex:1;min-width:180px">
                        <input type="text" name="search" placeholder="N° série, marque, modèle..."
                               value="{{ request('search') }}"
                               class="w-full border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <select name="etat" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Tous les états</option>
                            <option value="BON" {{ request('etat') == 'BON' ? 'selected' : '' }}>BON</option>
                            <option value="EN_PANNE" {{ request('etat') == 'EN_PANNE' ? 'selected' : '' }}>EN PANNE</option>
                            <option value="HORS_USAGE" {{ request('etat') == 'HORS_USAGE' ? 'selected' : '' }}>HORS USAGE</option>
                        </select>
                    </div>
                    <div>
                        <select name="code_bureau" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Tous les centres</option>
                            @foreach($centres as $c)
                                <option value="{{ $c->code_bureau }}" {{ request('code_bureau') == $c->code_bureau ? 'selected' : '' }}>
                                    {{ $c->nom_centre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="sous_famille" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Toutes les sous-familles</option>
                            @foreach($sousFamilles as $sf)
                                <option value="{{ $sf->id_sous_famille }}" {{ request('sous_famille') == $sf->id_sous_famille ? 'selected' : '' }}>
                                    {{ $sf->nom_sous_famille }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <a href="{{ route('materiels.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                            Réinitialiser
                        </a>
                    </div>
                </form>

                <div class="overflow-hidden rounded-lg border border-gray-200 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                @php $sortIcon = fn($c) => request('sort_by') == $c ? (request('sort_order') == 'asc' ? '▲' : '▼') : ''; @endphp
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'num_serie', 'sort_order' => request('sort_by') == 'num_serie' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">N° Série {!! $sortIcon('num_serie') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'centre', 'sort_order' => request('sort_by') == 'centre' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Centre {!! $sortIcon('centre') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'code_bureau', 'sort_order' => request('sort_by') == 'code_bureau' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Bureau {!! $sortIcon('code_bureau') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'sous_famille', 'sort_order' => request('sort_by') == 'sous_famille' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Sous-Famille {!! $sortIcon('sous_famille') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'marque', 'sort_order' => request('sort_by') == 'marque' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Marque {!! $sortIcon('marque') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'modele', 'sort_order' => request('sort_by') == 'modele' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Modèle {!! $sortIcon('modele') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'cab', 'sort_order' => request('sort_by') == 'cab' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">CAB {!! $sortIcon('cab') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'num_marche', 'sort_order' => request('sort_by') == 'num_marche' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Marché {!! $sortIcon('num_marche') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'num_ordre', 'sort_order' => request('sort_by') == 'num_ordre' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">N° Ordre {!! $sortIcon('num_ordre') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'machine', 'sort_order' => request('sort_by') == 'machine' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Machine {!! $sortIcon('machine') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'date_affectation', 'sort_order' => request('sort_by') == 'date_affectation' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">Date Affect. {!! $sortIcon('date_affectation') !!}</a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'etat', 'sort_order' => request('sort_by') == 'etat' && request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white hover:text-blue-200">État {!! $sortIcon('etat') !!}</a>
                                </th>
                                @if(auth()->user()->isAdmin())
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($materiels as $m)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $m->num_serie }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->centre?->nom_centre ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->code_bureau }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->marque?->sousFamille?->nom_sous_famille ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->marque?->nom_marque ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->modele?->nom_modele ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->cab }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->num_marche }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->num_ordre }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $m->machine }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $m->date_affectation }}</td>
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

                <div class="mt-4">
                    {{ $materiels->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
