<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau centre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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

                    <form action="{{ route('centres.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="code_bureau" class="block text-sm font-medium text-gray-700 mb-1">
                                    Code bureau <span class="text-red-600">*</span>
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
                                    Nom du centre <span class="text-red-600">*</span>
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
                                    Région <span class="text-red-600">*</span>
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
                                    Matricule <span class="text-red-600">*</span>
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
                                    Adresse IP <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="adresse_ip"
                                       id="adresse_ip"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('adresse_ip') border-red-500 @enderror"
                                       value="{{ old('adresse_ip') }}"
                                       placeholder="Ex: 192.168.1"
                                       required>
                                @error('adresse_ip')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="type_consultation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Type de consultation <span class="text-red-600">*</span>
                                </label>
                                <select name="type_consultation"
                                        id="type_consultation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('type_consultation') border-red-500 @enderror"
                                        required>
                                    <option value="">-- Sélectionner un type --</option>
                                    <option value="GLOBAL" {{ old('type_consultation') == 'GLOBAL' ? 'selected' : '' }}>Consultation globale</option>
                                    <option value="PAR_CENTRE" {{ old('type_consultation') == 'PAR_CENTRE' ? 'selected' : '' }}>Consultation par centre</option>
                                    <option value="ADMIN" {{ old('type_consultation') == 'ADMIN' ? 'selected' : '' }}>Administrateur</option>
                                </select>
                                @error('type_consultation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('centres.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-sm font-medium rounded transition-colors">
                                Créer le centre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>