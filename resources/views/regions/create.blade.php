@extends('layouts.app')

@section('title', 'Ajouter une région')
@section('page-title', '➕ Ajouter une région')

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-plus-circle text-blue-600 mr-2"></i> Nouvelle région
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

                <form action="{{ route('regions.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="libelle_region" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tag text-blue-600 mr-1"></i> Libellé <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               name="libelle_region" 
                               id="libelle_region" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('libelle_region') border-red-500 @enderror" 
                               value="{{ old('libelle_region') }}" 
                               placeholder="Ex: Marrakech"
                               required>
                        @error('libelle_region')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="abreviation" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-shortcode text-blue-600 mr-1"></i> Abréviation <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               name="abreviation" 
                               id="abreviation" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('abreviation') border-red-500 @enderror" 
                               value="{{ old('abreviation') }}" 
                               placeholder="Ex: MKH"
                               maxlength="5"
                               required>
                        <p class="mt-1 text-sm text-gray-500">3 à 5 caractères maximum</p>
                        @error('abreviation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('regions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-1"></i> Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-1"></i> Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection