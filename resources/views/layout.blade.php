<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon Précieux Vélo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <style>
        th,
        td {
            padding-left: 10px;
            padding-right: 10px;

        }
    </style>
</head>

<body>
    <nav class="navbar is-light">
        <div class="navbar-menu">
            <div class="navbar-start">
                @if(auth()->check())
                <a href="/" class="navbar-item {{ request()->is('/') ? 'is-active' : '' }}">Accueil</a>
                <a href="/gestion-membres" class="navbar-item {{ request()->is('gestion-membres') ? 'is-active' : '' }}">Gestion des membres</a>
                <a href="/gestion-stationnements" class="navbar-item {{ request()->is('gestion-stationnements') ? 'is-active' : '' }}">Gestion des stationnements</a>
                <a href="/gestion-reparations" class="navbar-item {{ request()->is('gestion-reparations') ? 'is-active' : '' }}">Gestion des réparations</a>
                @else
                <a href="/" class="navbar-item {{ request()->is('/') ? 'is-active' : '' }}">Accueil</a>
                @endif
            </div>
            <div class="navbar-end">
                @if(auth()->check())
                <a href="/deconnexion" class="navbar-item">Déconnexion</a>
                @else
                <a href="/connexion" class="navbar-item {{ request()->is('connexion') ? 'is-active' : '' }}">Connexion</a>
                @endif
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('contenu')
    </div>
</body>

</html>