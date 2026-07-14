<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle région') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <strong>Veuillez corriger les erreurs :</strong>
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
                                Libellé <span class="text-red-600">*</span>
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
                                Abréviation <span class="text-red-600">*</span>
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
                            <a href="{{ route('regions.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium rounded transition-colors">
                                Créer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>