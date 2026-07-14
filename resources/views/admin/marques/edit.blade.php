<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier une marque
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <form method="POST"
              action="{{ route('admin.marques.update', $marque->id_marque) }}"
              class="bg-white shadow rounded-lg p-6">

            @csrf
            @method('PUT')

            {{-- Famille --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    Famille
                </label>

                <select name="id_famille"
                        id="famille_select"
                        class="w-full border border-gray-300 rounded px-3 py-2">

                    <option value="">-- Choisir une famille --</option>

                    @foreach($familles as $famille)
                        <option value="{{ $famille->id_famille }}"
                            {{ old('id_famille', $marque->sousFamille->id_famille) == $famille->id_famille ? 'selected' : '' }}>
                            {{ $famille->nom_famille }}
                        </option>
                    @endforeach

                </select>

                @error('id_famille')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sous famille --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    Sous famille
                </label>

                <select name="id_sous_famille"
                        id="sous_famille_select"
                        class="w-full border border-gray-300 rounded px-3 py-2">

                    @foreach($sousFamilles as $sousFamille)
                        <option value="{{ $sousFamille->id_sous_famille }}"
                            {{ old('id_sous_famille', $marque->id_sous_famille) == $sousFamille->id_sous_famille ? 'selected' : '' }}>
                            {{ $sousFamille->nom_sous_famille }}
                        </option>
                    @endforeach

                </select>

                @error('id_sous_famille')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nom --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    Nom de la marque
                </label>

                <input
                    type="text"
                    name="nom_marque"
                    value="{{ old('nom_marque', $marque->nom_marque) }}"
                    placeholder="Nom de la marque"
                    class="w-full border border-gray-300 rounded px-3 py-2">

                @error('nom_marque')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">
                    Enregistrer
                </button>

                <a href="{{ route('admin.familles.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">
                    Annuler
                </a>
            </div>

        </form>
    </div>

    <script>
        const familleSelect = document.getElementById('famille_select');
        const sousFamilleSelect = document.getElementById('sous_famille_select');

        familleSelect.addEventListener('change', function () {

            let familleId = this.value;

            sousFamilleSelect.innerHTML =
                '<option value="">-- Choisir une sous famille --</option>';

            if (familleId) {
                fetch(`/familles/${familleId}/sous_familles`)
                    .then(response => response.json())
                    .then(data => {

                        data.forEach(sousFamille => {

                            sousFamilleSelect.innerHTML += `
                                <option value="${sousFamille.id_sous_famille}">
                                    ${sousFamille.nom_sous_famille}
                                </option>
                            `;

                        });

                    });
            }

        });
    </script>

</x-app-layout>