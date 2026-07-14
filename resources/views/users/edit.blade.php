<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Modifier un utilisateur</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('users.update', $user->matricule) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Matricule</label>
                    <input type="text" name="matricule"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        maxlength="8" pattern="[0-9]{8}"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        value="{{ old('matricule', $user->matricule) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nom</label>
                    <input type="text" name="nom"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('nom', $user->nom) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Prénom</label>
                    <input type="text" name="prenom"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('prenom', $user->prenom) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email personnel</label>
                    <input type="email" name="email_perso"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('email_perso', $user->email_perso) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                    <input type="text" name="tel"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        maxlength="10" pattern="[0-9]{10}"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        value="{{ old('tel', $user->tel) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">État</label>
                    <select name="etat" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="ACTIVE" {{ $user->etat == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                        <option value="RETRAITE" {{ $user->etat == 'RETRAITE' ? 'selected' : '' }}>RETRAITE</option>
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>