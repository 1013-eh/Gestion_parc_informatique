@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Changer votre mot de passe</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nouveau mot de passe</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Confirmer le mot de passe</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">
            Enregistrer
        </button>
    </form>
</div>

@endsection