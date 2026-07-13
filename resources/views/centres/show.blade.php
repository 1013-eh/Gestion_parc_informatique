@extends('layouts.app')

@section('title', 'Détails du centre')
@section('page-title', '📋 Détails du centre')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-building text-green-600 mr-2"></i> Centre : {{ $centre->code_bureau }}
                    </h2>
                    <div>
                        <a href="{{ route('centres.edit', $centre->code_bureau) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </a>
                        <a href="{{ route('centres.index') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-1"></i> Retour
                        </a>
                    </div>
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
                        <p class="font-medium"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $centre->type_consultation_color ?? 'gray' }}-100 text-{{ $centre->type_consultation_color ?? 'gray' }}-800">{{ $centre->type_consultation_libelle ?? 'N/A' }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection