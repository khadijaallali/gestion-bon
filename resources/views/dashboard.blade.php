<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR VERTICALE -->
        <div class="col-md-2 bg-dark min-vh-100 text-white p-3">
            <h4 class="text-center">Menu</h4>
            <ul class="nav flex-column mt-4 fs-5">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">🏠 Accueil</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">➕ Ajouter un bon</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">🔍 Rechercher</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">🖨️ Imprimer</a>
                </li>
                <li class="nav-item mt-4">
                    @auth
                        <div class="text-white small">👤 {{ Auth::user()->name }}<br>({{ Auth::user()->type ?? 'utilisateur' }})</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm mt-2">Se déconnecter</button>
                        </form>
                    @else
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Se connecter</a>
                    @endauth
                </li>
            </ul>
        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="col-md-10 p-4">
            <h1>Bienvenue sur la page d'accueil</h1>
            <p>Contenu principal ici...</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@extends('layouts.app')