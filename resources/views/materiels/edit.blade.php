<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un matériel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('materiels.update', $materiel->num_serie) }}" class="space-y-6">
                        @method('PATCH')
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- N° Série --}}
                            <div>
                                <x-input-label for="num_serie" :value="__('N° Série')" />
                                <x-text-input id="num_serie" class="block mt-1 w-full" type="text" name="num_serie" :value="old('num_serie', $materiel->num_serie)" required />
                                <x-input-error :messages="$errors->get('num_serie')" class="mt-2" />
                            </div>

                            {{-- Modèle dropdown --}}
                            <div>
                                <x-input-label for="id_modele" :value="__('Modèle')" />
                                <select id="id_modele" name="id_modele" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Sélectionner...</option>
                                    @foreach($modeles as $m)
                                        <option value="{{ $m->id_modele }}" {{ old('id_modele', $materiel->id_modele) == $m->id_modele ? 'selected' : '' }}>
                                            {{ $m->nom_modele }} ({{ $m->marque?->nom_marque ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_modele')" class="mt-2" />
                            </div>

                            {{-- Code bureau dropdown --}}
                            <div>
                                <x-input-label for="code_bureau" :value="__('Code bureau')" />
                                <select id="code_bureau" name="code_bureau" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Sélectionner...</option>
                                    @foreach($centres as $c)
                                        <option value="{{ $c->code_bureau }}" {{ old('code_bureau', $materiel->code_bureau) == $c->code_bureau ? 'selected' : '' }}>
                                            {{ $c->code_bureau }} - {{ $c->nom_centre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('code_bureau')" class="mt-2" />
                            </div>

                            {{-- Date affectation --}}
                            <div>
                                <x-input-label for="date_affectation" :value="__('Date d\'affectation')" />
                                <x-text-input id="date_affectation" class="block mt-1 w-full" type="date" name="date_affectation" :value="old('date_affectation', $materiel->date_affectation)" required />
                                <x-input-error :messages="$errors->get('date_affectation')" class="mt-2" />
                            </div>

                            {{-- État dropdown --}}
                            <div>
                                <x-input-label for="etat" :value="__('État')" />
                                <select id="etat" name="etat" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="BON" {{ old('etat', $materiel->etat) == 'BON' ? 'selected' : '' }}>BON</option>
                                    <option value="EN_PANNE" {{ old('etat', $materiel->etat) == 'EN_PANNE' ? 'selected' : '' }}>EN PANNE</option>
                                    <option value="HORS_USAGE" {{ old('etat', $materiel->etat) == 'HORS_USAGE' ? 'selected' : '' }}>HORS USAGE</option>
                                </select>
                                <x-input-error :messages="$errors->get('etat')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Modifier') }}</x-primary-button>
                            <a href="{{ route('materiels.index') }}">
                                <x-secondary-button type="button">{{ __('Annuler') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>