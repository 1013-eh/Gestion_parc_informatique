<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height:1.6;">

    <h2 style="color:#0f4c81;">
        Gestion du Parc Informatique - Barid Al-Maghrib
    </h2>

    <p>Bonjour,</p>

    <p>
        Trois tentatives de connexion avec un mot de passe incorrect ont été détectées sur votre compte.
    </p>

    <p>
        Par mesure de sécurité, votre mot de passe a été automatiquement réinitialisé.
    </p>

    <hr>

    <p>
        <strong>Adresse e-mail professionnelle :</strong><br>
        {{ $email }}
    </p>

    <p>
        <strong>Nouveau mot de passe temporaire :</strong><br>
        {{ $password }}
    </p>

    <hr>

    <p>
        Utilisez ce mot de passe pour vous connecter à l'application.
    </p>

    <p>
        Lors de votre prochaine connexion, il vous sera demandé de choisir un nouveau mot de passe avant d'accéder à l'application.
    </p>

    <p>
        Si vous n'êtes pas à l'origine de ces tentatives de connexion, veuillez contacter immédiatement l'administrateur.
    </p>

    <br>

    <p>
        Cordialement,<br>
        <strong>Gestion du Parc Informatique</strong><br>
        Barid Al-Maghrib
    </p>

</body>

</html>