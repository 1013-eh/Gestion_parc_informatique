<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Parc Informatique</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/">Gestion Parc</a>

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="/users">Utilisateurs</a>
            </li>

        </ul>

    </div>
</nav>

<div class="container mt-5">

    @yield('content')

</div>

</body>
</html>