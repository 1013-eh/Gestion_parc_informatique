<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Gestion des utilisateurs</h2>
            <a href="{{ route('users.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter un utilisateur
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-6">

        {{-- Recherche --}}
        <form method="GET" action="{{ route('users.index') }}" class="flex gap-3 mb-6">
            <input type="text" name="search"
                class="w-full border border-gray-300 rounded px-3 py-2"
                placeholder="Rechercher par matricule, nom, prénom ou email..."
                value="{{ $search }}">
            <button class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                Rechercher
            </button>
        </form>

        {{-- Message succès --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Tableau --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th class="py-3 px-4">Matricule</th>
                        <th class="py-3 px-4">Nom</th>
                        <th class="py-3 px-4">Prénom</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">GSM</th>
                        <th class="py-3 px-4">État</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b hover:bg-blue-50">
                        <td class="py-3 px-4">{{ $user->matricule }}</td>
                        <td class="py-3 px-4">{{ $user->nom }}</td>
                        <td class="py-3 px-4">{{ $user->prenom }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->tel }}</td>
                        <td class="py-3 px-4">
                            @if($user->etat == 'ACTIVE')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Actif</span>
                            @else
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">Retraité</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('users.edit', $user->matricule) }}"
                                class="bg-amber-500 hover:bg-amber-600 text-white text-sm py-1 px-3 rounded">
                                Modifier
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">
                            Aucun utilisateur enregistré.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>