<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome banner --}}
            <div class="bg-blue-800 rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold">
                    Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                </h3>
                <p class="text-blue-100 text-sm mt-1">
                    @if($isGlobalView)
                        Vous consultez les données de l'ensemble des centres.
                    @else
                        Vous consultez les données de votre centre : {{ auth()->user()->centre->nom_centre }}.
                    @endif
                </p>
            </div>

            {{-- Catégories --}}
            <div class="bg-blue-50 rounded-lg shadow-sm border border-gray p-6">
                <h3 class="text-sm font-semibold text-blue-900 uppercase tracking-wide mb-4">Catégories</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-800">Familles</p>
                            <p class="text-2xl font-bold text-blue-950">{{ $famillesCount }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v18M4 7h5m-5 5h5m-5 5h5M15 3l6 6m0 0l-6 6m6-6H9" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-800">Sous-familles</p>
                            <p class="text-2xl font-bold text-blue-950">{{ $sousFamillesCount }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                            <circle cx="7" cy="7" r="1.5" fill="currentColor" stroke="none" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-800">Marques</p>
                            <p class="text-2xl font-bold text-blue-950">{{ $marquesCount }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="4" y="4" width="16" height="16" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 10h16M10 4v16" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-800">Modèles</p>
                            <p class="text-2xl font-bold text-blue-950">{{ $modelesCount }}</p>
                        </div>
                    </div>

                </div>
            </div>

            @if($isGlobalView)
                {{-- Régions & Centres --}}
                <div class="bg-teal-50 rounded-lg shadow-sm border border-gray p-6">
                    <h3 class="text-sm font-semibold text-teal-900 uppercase tracking-wide mb-4">Régions et centres</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                <circle cx="12" cy="11" r="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div>
                                <p class="text-xs text-teal-800">Régions</p>
                                <p class="text-2xl font-bold text-teal-950">{{ $regionsCount }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 9h1m-1 4h1m4-4h1m-1 4h1M9 21v-4h6v4" />
                            </svg>
                            <div>
                                <p class="text-xs text-teal-800">Centres</p>
                                <p class="text-2xl font-bold text-teal-950">{{ $centresCount }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            {{-- Matériels --}}
            <div class="bg-amber-50 rounded-lg shadow-sm border border-gray p-6">
                <h3 class="text-sm font-semibold text-amber-900 uppercase tracking-wide mb-4">Matériel</h3>

                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="4" width="20" height="13" rx="1" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8M12 17v4" />
                    </svg>
                    <div>
                        <p class="text-xs text-amber-800">Matériels{{ $isGlobalView ? '' : ' (mon centre)' }}</p>
                        <p class="text-2xl font-bold text-amber-950">{{ $materielsTotal }}</p>
                    </div>
                </div>

                @if($isGlobalView)
                    <div class="mt-5 pt-5 border-t border-gray">
                        <table class="min-w-full divide-y divide-amber-200 text-sm">
                            <thead>
                                <tr>
                                    <th class="px-0 py-2 text-left font-medium text-amber-800">Centre</th>
                                    <th class="px-0 py-2 text-left font-medium text-amber-800">Matériels</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-amber-200">
                                @foreach($materielsParCentre as $row)
                                    <tr>
                                        <td class="px-0 py-2 text-amber-900">{{ $row->centre->nom_centre ?? 'N/A' }}</td>
                                        <td class="px-0 py-2 font-semibold text-amber-950">{{ $row->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Archives --}}
            <div class="bg-red-50 rounded-lg shadow-sm border border-gray p-6">
                <h3 class="text-sm font-semibold text-red-900 uppercase tracking-wide mb-4">Matériels archivés</h3>

                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 01-2-2V5a1 1 0 011-1h16a1 1 0 011 1v1a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8M10 12h4" />
                    </svg>
                    <div>
                        <p class="text-xs text-red-800">Archives{{ $isGlobalView ? '' : ' (mon centre)' }}</p>
                        <p class="text-2xl font-bold text-red-950">{{ $archivesTotal }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>