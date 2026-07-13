@extends('layouts.app')

@section('title', 'Détails de la région')
@section('page-title', '📋 Détails de la région')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i> {{ $region->libelle_region }}
                    </h2>
                    <div>
                        <a href="{{ route('regions.edit', $region->id_region) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </a>
                        <a href="{{ route('regions.index') }}" class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-1"></i> Retour
                        </a>
                    </div>
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
                    <i class="fas fa-building text-green-600 mr-2"></i> Centres dans cette région
                </h3>

                @if($region->centres->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse IP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($region->centres as $centre)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('centres.show', $centre->code_bureau) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $centre->code_bureau }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $centre->utilisateur->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><code>{{ $centre->adresse_ip }}</code></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $centre->type_consultation_color ?? 'gray' }}-100 text-{{ $centre->type_consultation_color ?? 'gray' }}-800">
                                            {{ $centre->type_consultation_libelle ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700">
                        <i class="fas fa-info-circle mr-2"></i> Aucun centre dans cette région
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection