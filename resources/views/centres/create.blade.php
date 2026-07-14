@extends('layouts.app')

@section('title', 'Ajouter un centre')
@section('page-title', '➕ Ajouter un centre')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-plus-circle text-green-600 mr-2"></i> Nouveau centre
                </h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <strong>❌ Veuillez corriger les erreurs :</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('centres.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="code_bureau" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-hashtag text-blue-600 mr-1"></i> Code bureau <span class="text-red-600">*</span>
                            </label>
                            <input type="number" 
                                   name="code_bureau" 
                                   id="code_bureau" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('code_bureau') border-red-500 @enderror" 
                                   value="{{ old('code_bureau') }}" 
                                   placeholder="Ex: 96614"
                                   required>
                            @error('code_bureau')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nom_centre" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-building text-blue-600 mr-1"></i> Nom du centre <span class="text-red-600">*</span>
                            </label>
                            <input type="text" 
                                   name="nom_centre" 
                                   id="nom_centre" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('nom_centre') border-red-500 @enderror" 
                                   value="{{ old('nom_centre') }}" 
                                   placeholder="Ex: AGENCE AM MARRAKECH GUELIZ"
                                   required>
                            @error('nom_centre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_region" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i> Région <span class="text-red-600">*</span>
                            </label>
                            <select name="id_region" 
                                    id="id_region" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('id_region') border-red-500 @enderror" 
                                    required>
                                <option value="">-- Sélectionner une région --</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                                        {{ $region->libelle_region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_region')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="matricule" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-id-card text-blue-600 mr-1"></i> Matricule <span class="text-red-600">*</span>
                            </label>
                            <select name="matricule" 
                                    id="matricule" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('matricule') border-red-500 @enderror" 
                                    required>
                                <option value="">-- Sélectionner un matricule --</option>
                                @foreach($users as $user)

                                    <option value="{{ $user->matricule }}" {{ old('matricule') == $user->matricule ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->matricule }})
                                    </option>
                                @endforeach
                            </select>
                            @error('matricule')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="adresse_ip" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-network-wired text-blue-600 mr-1"></i> Adresse IP <span class="text-red-600">*</span>
                            </label>
                            <input type="text" 
                                   name="adresse_ip" 
                                   id="adresse_ip" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('adresse_ip') border-red-500 @enderror" 
                                   value="{{ old('adresse_ip') }}" 
                                   placeholder="Ex: 192.168.1.1"
                                   required>
                            @error('adresse_ip')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type_consultation" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-cog text-blue-600 mr-1"></i> Type de consultation <span class="text-red-600">*</span>
                            </label>
                            <select name="type_consultation" 
                                    id="type_consultation" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('type_consultation') border-red-500 @enderror" 
                                    required>
                                <option value="">-- Sélectionner un type --</option>
                                <option value="GLOBAL" {{ old('type_consultation') == 'GLOBAL' ? 'selected' : '' }}>🌍 Consultation globale</option>
                                <option value="PAR_CENTRE" {{ old('type_consultation') == 'PAR_CENTRE' ? 'selected' : '' }}>🏢 Consultation par centre</option>
                                <option value="ADMIN" {{ old('type_consultation') == 'ADMIN' ? 'selected' : '' }}>🔒 Administrateur</option>
                            </select>
                            @error('type_consultation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between mt-4">
                        <a href="{{ route('centres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-1"></i> Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-1"></i> Créer le centre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection