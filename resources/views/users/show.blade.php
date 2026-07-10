@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Détails de l'utilisateur</h2>

    <div class="card">

        <div class="card-header">
            Informations de l'utilisateur
        </div>

        <div class="card-body">

            <p><strong>Matricule :</strong> {{ $user->matricule }}</p>

            <p><strong>Nom :</strong> {{ $user->nom }}</p>

            <p><strong>Prénom :</strong> {{ $user->prenom }}</p>

            <p><strong>Email :</strong> {{ $user->email }}</p>

            <p><strong>Téléphone :</strong> {{ $user->tel }}</p>

            <p><strong>État :</strong> {{ $user->etat }}</p>

        </div>

    </div>

    <br>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Retour
    </a>

</div>

@endsection