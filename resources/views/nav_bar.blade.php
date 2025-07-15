
<!-- Barre de navigation principale -->
<div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom bg-light no-print ">
    <!-- Bouton ☰ pour ouvrir le menu latéral -->
    <div class="d-flex align-items-center">
        @if(auth()->check() && auth()->user()->role === 'admin')
        <button class="btn btn-outline-secondary me-5 fs-4 no-print" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            ☰
        </button>
        @endif

        <!-- Logo + Titre -->
        <a class="navbar-brand fs-3 text-dark no-print" href="{{ url('/bons') }}">
            <img src="{{ asset('images/image.png') }}" alt="Logo" class="d-inline-block align-text-top" style="width: 50px; height: 50px;">
            <h3 class="d-inline ms-2 no-print">Bienvenue !</h3>
        </a>
    </div>

    <!-- Navigation horizontale -->
    <ul class="nav nav-tabs fs-5">
        <li class="nav-item">
            <a class="nav-link active text-dark no-print" href="/bons">Accueil</a>
        </li>
        <li class="nav-item no-print">
            <a class="nav-link text-dark" href="/saisi">Ajouter un bon</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark no-print" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                Rechercher
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="{{ route('recherche.matricule') }}">Par N° matricule</a></li>
                <li><a class="dropdown-item" href="{{ route('recherche.vehicule') }}">Par N° véhicule</a></li> 
                <li><a class="dropdown-item" href="{{ route('recherche.bon') }}">Par N° bon</a></li>
            </ul>
        </li>

     <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark no-print" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                imprimer
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="{{ route('impression.bon') }}">Par bon</a></li>
                <li><a class="dropdown-item" href="{{ route('impression.preneur') }}">Par agent</a></li> 
                <li><a class="dropdown-item" href="{{ route('impression.site') }}">Par site</a></li>
                <li><a class="dropdown-item" href="{{ route('impression.service') }}">Par service</a></li>
                <li><a class="dropdown-item" href="{{ route('impression.vehicule') }}">Par véhicule</a></li>
            </ul>
        </li>
    </ul>

    <!-- Partie profil utilisateur -->
    <div class="d-flex align-items-center no-print">
        @auth
                <a href="/profile"  class="me-3 fw-semibold text-decoration-none text-dark no-print">
                {{ Auth::user()->name }} 👤 
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm no-print" type="submit">Se déconnecter</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary no-print">Se connecter</a>
        @endauth
    </div>
</div>

 @if(auth()->check() && auth()->user()->role === 'admin')
    <aside class="sidebar no-print">

<!-- Offcanvas Sidebar gauche -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title" id="sidebarMenuLabel">Menu</h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
        <li class="nav-item mb-2">
       <h4> <a class="nav-link" href="/bons">🏠 Accueil</a> </h4>
      </li>
         <li class="nav-item dropdown">
           <h4> <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                📍 Sites
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="/sites/create"> ➕ Ajouter site</a></li>
                <li><a class="dropdown-item" href="/sites"> 📃 Gérer sites</a></li>

            </ul>
        </li> </h4>
        <li class="nav-item dropdown">
            <h4><a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                💼 Services
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="/services/create"> ➕ Ajouter service</a></li>
                <li><a class="dropdown-item" href="/services"> 📃 Gérer services</a></li>

            </ul>
        </li> </h4>
         <li class="nav-item dropdown">
            <h4><a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                🚗 Véhicules
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="/vehicules/create"> ➕ Ajouter  véhicule </a></li>
                <li><a class="dropdown-item" href="/vehicules"> 📃 Gérer vehicule</a></li>

            </ul>
        </li> </h4>
         <li class="nav-item dropdown">
           <h4> <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                👤 Preneurs
            </a> 
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="/preneurs/create"> ➕ Ajouter preneur</a></li>
                <li><a class="dropdown-item" href="/preneurs"> 📃 Gérer preneur</a></li>

            </ul>
        </li> </h4>
    <li class="nav-item dropdown">
            <h4><a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                Utilisateurs
            </a>
            <ul class="dropdown-menu fs-5">
                <li><a class="dropdown-item" href="/users/create"> ➕ Ajouter Utilisateurs</a></li>
                <li><a class="dropdown-item" href="/users"> 📃 Gérer utilisateurs</a></li>

            </ul>
        </li> </h4>
    <hr>
    <div class="position-absolute bottom-0 start-0 w-100 p-3 border-top">
    <a href="/support" class="text-decoration-none text-dark">
        <h6 class="mb-0">🛠️ Aide et support</h6>
    </a>
</div>
  </div>
</div>
</aside>
  @endif
