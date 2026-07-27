<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une sous famille</h2>
    </x-slot>
    <div class="max-w-2xl mx-auto py-6">
        <form method="POST" action="{{ route('admin.sous_familles.store') }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Famille</label>
                <select name="id_famille" class="w-full border border-gray-300 rounded px-3 py-2">
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
                <label for="" class="block text-gray-700 font-semibold mb-2">Nom de la sous Famille</label>
                <input type="text" name="nom_sous_famille" placeholder="Nom de la sous famille" class="w-full border border-gray-300 rounded px-3 py-2">
                @error('nom_sous_famille')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">Créer</button>
            <a href="{{ route('admin.familles.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">
                    Annuler
                </a>
        </form>
    </div>
</x-app-layout>
