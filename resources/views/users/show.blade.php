<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Détails de l'utilisateur</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <div class="bg-blue-900 text-white px-6 py-3 font-semibold">
                Informations de l'utilisateur
            </div>

            <div class="p-6 space-y-3">
                <p><span class="font-semibold text-gray-700">Matricule :</span> {{ $user->matricule }}</p>
                <p><span class="font-semibold text-gray-700">Nom :</span> {{ $user->nom }}</p>
                <p><span class="font-semibold text-gray-700">Prénom :</span> {{ $user->prenom }}</p>
                <p><span class="font-semibold text-gray-700">Email :</span> {{ $user->email }}</p>
                <p><span class="font-semibold text-gray-700">Téléphone :</span> {{ $user->tel }}</p>
                <p>
                    <span class="font-semibold text-gray-700">État :</span>
                    @if($user->etat == 'ACTIVE')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Actif</span>
                    @else
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">Retraité</span>
                    @endif
                </p>
            </div>

        </div>

        <div class="mt-4">
            <a href="{{ route('users.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded">
                Retour
            </a>
        </div>
    </div>
</x-app-layout>