<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Catégories --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-blue-900 mb-4">Catégories</h3>
                <div class="space-y-1 text-sm text-gray-700">
                    <p>Nombre de familles : <span class="font-semibold text-blue-800">{{ $isGlobalView ? $famillesCount : $familles->count() }}</span></p>
                    <p>Nombre de sous-familles : <span class="font-semibold text-blue-800">{{ $isGlobalView ? $sousFamillesCount : $sousFamilles->count() }}</span></p>
                    <p>Nombre de marques : <span class="font-semibold text-blue-800">{{ $isGlobalView ? $marquesCount : $marques->count() }}</span></p>
                    <p>Nombre de modèles : <span class="font-semibold text-blue-800">{{ $isGlobalView ? $modelesCount : $modeles->count() }}</span></p>
                </div>
            </div>

            @if($isGlobalView)
                {{-- Régions & Centres --}}
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-base font-semibold text-teal-800 mb-4">Régions et centres</h3>
                    <div class="space-y-1 text-sm text-gray-700">
                        <p>Nombre de régions : <span class="font-semibold text-teal-700">{{ $regionsCount }}</span></p>
                        <p>Nombre de centres : <span class="font-semibold text-teal-700">{{ $centresCount }}</span></p>
                    </div>
                </div>
            @endif

            {{-- Matériels --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-amber-800 mb-4">Matériels</h3>
                <p class="text-sm text-gray-700 mb-3">Nombre total de matériels : <span class="font-semibold text-amber-700">{{ $materielsTotal }}</span></p>

                @if($isGlobalView)
                    <div class="pt-3 border-t border-gray-100 text-sm text-gray-700 space-y-1">
                        @foreach($materielsParCentre as $row)
                            <p>{{ $row->centre->nom_centre ?? 'N/A' }} : <span class="font-semibold text-amber-700">{{ $row->total }}</span></p>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Archives --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-base font-semibold text-red-800 mb-4">Matériels archivés</h3>
                <p class="text-sm text-gray-700 mb-3">Nombre total d'archives : <span class="font-semibold text-red-700">{{ $archivesTotal }}</span></p>

                @if($isGlobalView)
                    <div class="pt-3 border-t border-gray-100 text-sm text-gray-700 space-y-1">
                        @foreach($archivesParCentre as $row)
                            <p>{{ $row['centre']->nom_centre ?? 'N/A' }} : <span class="font-semibold text-red-700">{{ $row['total'] }}</span></p>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>