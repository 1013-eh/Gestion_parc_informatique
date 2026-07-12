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

                            {{-- Famille --}}
                            <div>
                                <x-input-label for="famille" value="Famille" />
                                <div class="flex items-center gap-2">
                                    <select id="famille" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Sélectionner...</option>
                                        @foreach($familles as $f)
                                            <option value="{{ $f->id_famille }}" {{ $selectedFamille->id_famille == $f->id_famille ? 'selected' : '' }}>
                                                {{ $f->nom_famille }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(Route::has('admin.familles.create'))
                                        <a href="{{ route('admin.familles.create') }}" target="_blank" class="text-blue-500 text-2xl leading-none">+</a>
                                    @endif
                                </div>
                            </div>

                            {{-- Sous Famille --}}
                            <div>
                                <x-input-label for="id_sous_famille" value="Sous Famille" />
                                <div class="flex items-center gap-2">
                                    <select id="id_sous_famille" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" disabled>
                                        <option value="">Sélectionner d'abord une famille</option>
                                    </select>
                                    @if(Route::has('admin.sous_familles.create'))
                                        <a href="{{ route('admin.sous_familles.create') }}" target="_blank" class="text-blue-500 text-2xl leading-none">+</a>
                                    @endif
                                </div>
                            </div>

                            {{-- Marque --}}
                            <div>
                                <x-input-label for="id_marque" value="Marque" />
                                <div class="flex items-center gap-2">
                                    <select id="id_marque" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" disabled>
                                        <option value="">Sélectionner d'abord une sous famille</option>
                                    </select>
                                    @if(Route::has('admin.marques.create'))
                                        <a href="{{ route('admin.marques.create') }}" target="_blank" class="text-blue-500 text-2xl leading-none">+</a>
                                    @endif
                                </div>
                            </div>

                            {{-- Modèle --}}
                            <div>
                                <x-input-label for="id_modele" value="Modèle" />
                                <div class="flex items-center gap-2">
                                    <select id="id_modele" name="id_modele" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" disabled>
                                        <option value="">Sélectionner d'abord une marque</option>
                                    </select>
                                    @if(Route::has('admin.modeles.create'))
                                        <a href="{{ route('admin.modeles.create') }}" target="_blank" class="text-blue-500 text-2xl leading-none">+</a>
                                    @endif
                                </div>
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

                        @push('scripts')
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const famille = document.getElementById('famille');
                            const sousFamille = document.getElementById('id_sous_famille');
                            const marque = document.getElementById('id_marque');
                            const modele = document.getElementById('id_modele');

                            function resetSelect(select, placeholder) {
                                select.innerHTML = `<option value="">${placeholder}</option>`;
                                select.disabled = true;
                            }

                            async function fetchSousFamilles(id) {
                                const res = await fetch(`/api/sous-familles/${id}`);
                                const data = await res.json();
                                sousFamille.innerHTML = '<option value="">Sélectionner...</option>';
                                data.forEach(sf => {
                                    sousFamille.innerHTML += `<option value="${sf.id_sous_famille}">${sf.nom_sous_famille}</option>`;
                                });
                                sousFamille.disabled = false;
                            }

                            async function fetchMarques(id) {
                                const res = await fetch(`/api/marques/${id}`);
                                const data = await res.json();
                                marque.innerHTML = '<option value="">Sélectionner...</option>';
                                data.forEach(m => {
                                    marque.innerHTML += `<option value="${m.id_marque}">${m.nom_marque}</option>`;
                                });
                                marque.disabled = false;
                            }

                            async function fetchModeles(id) {
                                const res = await fetch(`/api/modeles/${id}`);
                                const data = await res.json();
                                modele.innerHTML = '<option value="">Sélectionner...</option>';
                                data.forEach(m => {
                                    modele.innerHTML += `<option value="${m.id_modele}">${m.nom_modele}</option>`;
                                });
                                modele.disabled = false;
                            }

                            famille.addEventListener('change', function () {
                                const id = this.value;
                                resetSelect(sousFamille, 'Sélectionner d\'abord une famille');
                                resetSelect(marque, 'Sélectionner d\'abord une sous famille');
                                resetSelect(modele, 'Sélectionner d\'abord une marque');
                                if (!id) return;
                                sousFamille.innerHTML = '<option value="">Chargement...</option>';
                                fetchSousFamilles(id);
                            });

                            sousFamille.addEventListener('change', function () {
                                const id = this.value;
                                resetSelect(marque, 'Sélectionner d\'abord une sous famille');
                                resetSelect(modele, 'Sélectionner d\'abord une marque');
                                if (!id) return;
                                marque.innerHTML = '<option value="">Chargement...</option>';
                                fetchMarques(id);
                            });

                            marque.addEventListener('change', function () {
                                const id = this.value;
                                resetSelect(modele, 'Sélectionner d\'abord une marque');
                                if (!id) return;
                                modele.innerHTML = '<option value="">Chargement...</option>';
                                fetchModeles(id);
                            });

                            // Auto restore if editing
                            async function restoreEdit() {
                                const sfVal = "{{ $selectedSousFamille->id_sous_famille }}";
                                const mqVal = "{{ $selectedMarque->id_marque }}";
                                const mdVal = "{{ $selectedModele->id_modele }}";

                                await fetchSousFamilles(famille.value);
                                sousFamille.value = sfVal;

                                await fetchMarques(sfVal);
                                marque.value = mqVal;

                                await fetchModeles(mqVal);
                                modele.value = mdVal;
                            }

                            if (famille.value) restoreEdit();
                        });
                        </script>
                        @endpush

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