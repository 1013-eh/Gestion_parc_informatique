<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier une sous famille
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <form method="POST"
              action="{{ route('admin.sous_familles.update', $sousFamille->id_sous_famille) }}"
              class="bg-white shadow rounded-lg p-6">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    Nom de la sous famille
                </label>

                <input
                    type="text"
                    name="nom_sous_famille"
                    value="{{ old('nom_sous_famille', $sousFamille->nom_sous_famille) }}"
                    placeholder="Nom de la sous famille"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                @error('nom_sous_famille')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    Famille
                </label>

                <select
                    name="id_famille"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">-- Choisir une famille --</option>

                    @foreach($familles as $famille)
                        <option value="{{ $famille->id_famille }}"
                            {{ old('id_famille', $sousFamille->id_famille) == $famille->id_famille ? 'selected' : '' }}>
                            {{ $famille->nom_famille }}
                        </option>
                    @endforeach

                </select>

                @error('id_famille')
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
</x-app-layout>