<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Ajouter un utilisateur</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">

            {{-- Erreurs --}}
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Matricule</label>
                    <input type="text" name="matricule" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nom</label>
                    <input type="text" name="nom" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Prénom</label>
                    <input type="text" name="prenom" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email personnel</label>
                    <input type="email" name="email_perso" value="{{ old('email_perso') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                    <input type="text" name="tel" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">État</label>
                    <select name="etat" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="RETRAITE">RETRAITE</option>
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                        Enregistrer
                    </button>
                    <a href="{{ route('users.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded">
                        Retour
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>