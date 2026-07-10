@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Modifier un utilisateur</h2>

    <form action="{{ route('users.update', $user->matricule) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Matricule</label>
            <input type="text"
                   name="matricule"
                   class="form-control"
                   maxlength="8"
                   pattern="[0-9]{8}"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                   value="{{ old('matricule', $user->matricule) }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text"
                   name="nom"
                   class="form-control"
                   value="{{ old('nom', $user->nom) }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text"
                   name="prenom"
                   class="form-control"
                   value="{{ old('prenom', $user->prenom) }}"
                   required>
        </div>

        <div class="mb-3">
          <label>Email personnel</label>

        <input
                    type="email"
                    name="email_perso"
                    class="form-control"
                    value="{{ old('email_perso', $user->email_perso) }}">
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text"
                   name="tel"
                   class="form-control"
                   maxlength="10"
                   pattern="[0-9]{10}"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                   value="{{ old('tel', $user->tel) }}"
                   required>
        </div>

        <div class="mb-3">
            <label>État</label>
            <select name="etat" class="form-select" required>
                <option value="ACTIVE" {{ $user->etat == 'ACTIVE' ? 'selected' : '' }}>
                    ACTIVE
                </option>
                <option value="RETRAITE" {{ $user->etat == 'RETRAITE' ? 'selected' : '' }}>
                    RETRAITE
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Enregistrer les modifications
        </button>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Annuler
        </a>

    </form>

</div>

@endsection