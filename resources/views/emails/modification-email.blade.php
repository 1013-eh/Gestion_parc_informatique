<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modification du compte</title>
</head>
<body>

<h2>Bonjour {{ $user->prenom }} {{ $user->nom }},</h2>

<p>Votre compte Barid Al-Maghrib a été mis à jour.</p>

@if($ancienEmail != $nouvelEmail)
<p><strong>Ancienne adresse professionnelle :</strong></p>
<p>{{ $ancienEmail }}</p>

<p><strong>Nouvelle adresse professionnelle :</strong></p>
<p>{{ $nouvelEmail }}</p>
@endif

<p>Si vous n'êtes pas à l'origine de cette modification, veuillez contacter votre administrateur.</p>

<p>Cordialement,<br>
Barid Al-Maghrib</p>

</body>
</html>