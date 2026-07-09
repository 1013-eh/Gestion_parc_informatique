<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer un modele</h2>
    </x-slot>
    <div class="max-w-2xl mx-auto py-6">
        <form method="POST" action="{{ route('admin.modeles.store') }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Famille</label>
                <select name="id_famille" class="w-full border border-gray-300 rounded px-3 py-2" id="famille_select">
                    <option value="">-- Choisir une famille --</option>
                    @foreach($familles as $famille)
                    <option value="{{ $famille->id_famille }}">
                        {{ $famille->nom_famille }}
                    </option>
                    @endforeach
                </select>
                @error('id_famille')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Sous famille</label>
                <select name="id_sous_famille" id="sous_famille_select" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Choisir d'abord une famille --</option>
                </select>
                @error('id_sous_famille')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Marque</label>
                <select name="id_marque" id="marque_select" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Choisir d'abord une sous famille --</option>
                </select>
                @error('id_marque')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="" class="block text-gray-700 font-semibold mb-2">Nom du modele</label>
                <input type="text" name="nom_modele" placeholder="Nom du modele" class="w-full border border-gray-300 rounded px-3 py-2">
                @error('nom_modele')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">Créer</button>
        </form>
    </div>

    <script>
        document.getElementById('famille_select').addEventListener('change', function() {
            const familleId = this.value;
            const sousFamilleSelect = document.getElementById('sous_famille_select');

            // Réinitialiser le select
            sousFamilleSelect.innerHTML = '<option value="">-- Choisir une sous famille --</option>';

            if (familleId) {
                // Appel Ajax vers notre route
                fetch(`/familles/${familleId}/sous_familles`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(sousFamille => {
                            sousFamilleSelect.innerHTML += `
                        <option value="${sousFamille.id_sous_famille}">
                            ${sousFamille.nom_sous_famille}
                        </option>`;
                        });
                    });
            }
        });
        document.getElementById('sous_famille_select').addEventListener('change', function() {
            const sousFamilleId = this.value;
            const marqueSelect = document.getElementById('marque_select');

            // Réinitialiser le select
            marqueSelect.innerHTML = '<option value="">-- Choisir une marque --</option>';

            if (sousFamilleId) {
                fetch(`/sous_familles/${sousFamilleId}/marques`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(marque => {
                            marqueSelect.innerHTML += `
                    <option value="${marque.id_marque}">
                        ${marque.nom_marque}
                    </option>`;
                        });
                    });
            }
        });
    </script>

</x-app-layout>