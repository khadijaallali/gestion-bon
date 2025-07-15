<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Connexion')</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .auth-wrapper {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100vh;
        }

        .auth-left, .auth-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .auth-left {
            background-color: #6c757d; /* gris foncé */
            color: white;
        }

        .auth-right {
            background-color: white;
        }

        .auth-right form {
            width: 100%;
            max-width: 350px;
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
            }

            .auth-left, .auth-right {
                border-radius: 0 !important;
                height: 50vh;
            }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <!-- Partie gauche -->
    <div class="auth-left">
        <img src="{{ asset('images/image.png') }}" alt="Logo" style="width: 90px; height: 90px;" class="mb-4">
        <h2 class="mb-3">Bienvenue !</h2>
        <p class="text-center px-3">Connectez-vous pour accéder au système de gestion des bons de carburant Auto Hall.</p>
    </div>

    <!-- Partie droite -->
    <div class="auth-right">
        <h3 class="mb-4 text-secondary">Connexion</h3>
        <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input id="password" type="password" class="form-control" name="password" required>

        <div class="text-end mt-1">
            <a href="{{ route('password.request') }}" class="text-decoration-none text-secondary small">
                Mot de passe oublié ?
            </a>
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
    </div>

    <button type="submit" class="btn btn-secondary w-100">Se connecter</button>
</form>

</div>  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
