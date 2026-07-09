<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une famille</h2>
    </x-slot>
    <div class="max-w-2xl mx-auto py-6">
        <form method="POST" action="{{ route('admin.familles.store') }}" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="" class="block text-gray-700 font-semibold mb-2">Nom de Famille</label>
                <input type="text" name="nom_famille" placeholder="Nom de la famille" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">Créer</button>
        </form>
    </div>
</x-app-layout>