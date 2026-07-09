<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.familles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une famille
            </a>
            <a href="{{ route('admin.sous_familles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une sous famille
            </a>
            <a href="{{ route('admin.marques.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une marque
            </a>
            <a href="{{ route('admin.modeles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter un modele
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">
        @foreach($familles as $famille)
        <div class="bg-white shadow rounded-lg p-4 mb-4">

            {{-- Famille --}}
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-blue-700 text-lg">
                    {{ $famille->nom_famille }}
                </h3>
                <a href="{{ route('admin.familles.edit', $famille->id_famille) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                    Modifier
                </a>
            </div>

            {{-- Sous-familles --}}
            @foreach($famille->sousFamilles as $sousFamille)
            <div class="ml-6 mt-2 flex justify-between items-center border-l-2 border-blue-200 pl-3">
                <span class="text-gray-700">└── {{ $sousFamille->nom_sous_famille }}</span>
                <a href="{{ route('admin.sous_familles.edit', $sousFamille->id_sous_famille) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white text-sm py-1 px-3 rounded">
                    Modifier
                </a>
            </div>
            {{-- Marques --}}
            @foreach($sousFamille->marques as $marque)
            <div class="ml-12 mt-1 flex justify-between items-center border-l-2 border-gray-200 pl-3">
                <span class="text-gray-600">└── {{ $marque->nom_marque }}</span>
                <a href="{{ route('admin.marques.edit', $marque->id_marque) }}"
                    class="bg-gray-400 hover:bg-gray-500 text-white text-sm py-1 px-3 rounded">
                    Modifier
                </a>
            </div>
            {{-- Modèles --}}
            @foreach($marque->modeles as $modele)
            <div class="ml-20 mt-1 flex justify-between items-center border-l-2 border-gray-100 pl-3">
                <span class="text-gray-500">└── {{ $modele->nom_modele }}</span>
                <a href="{{ route('admin.modeles.edit', $modele->id_modele) }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm py-1 px-3 rounded">
                    Modifier
                </a>
            </div>
            @endforeach
            @endforeach
            @endforeach


        </div>
        @endforeach
    </div>

</x-app-layout>