@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">

    <h2 class="mb-4">Ajouter un utilisateur</h2>

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Matricule</label>
            <input type="text" name="matricule" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

    

        <div class="mb-3">
            <label>Email personnel</label>
            <input type="email" name="email_perso" class="form-control" value="{{ old('email_perso') }}">

        </div>


        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="tel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>État</label>
    <select name="etat" class="form-select">
         <option value="ACTIVE">ACTIVE</option>
         <option value="RETRAITE">RETRAITE</option>
    </select>
        </div>

        <button type="submit" class="btn btn-success">
            Enregistrer
        </button>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

@endsection