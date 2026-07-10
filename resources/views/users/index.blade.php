<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </h2>
    </x-slot>  

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Gestion des utilisateurs</h2>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Ajouter un utilisateur
        </a>

    </div>


<form method="GET" action="{{ route('users.index') }}" class="row mb-3">

    <div class="col-md-6">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Rechercher par matricule, nom, prénom ou email..."
            value="{{ $search }}">
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary">
            Rechercher
        </button>
    </div>

</form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">

            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>GSM</th>
                <th>État</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>

                <td>{{ $user->matricule }}</td>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->prenom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tel }}</td>
                <td>
    @if($user->etat == 'ACTIVE')
        <span class="badge bg-success">Actif</span>
    @else
        <span class="badge bg-secondary">Retraité</span>
    @endif
</td>
<td>
    <a href="{{ route('users.edit', $user->matricule) }}"
       class="btn btn-warning btn-sm">
        Modifier
    </a>
</td>
            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center">
                    Aucun utilisateur enregistré.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>
{{ $users->links() }}
</x-app-layout>