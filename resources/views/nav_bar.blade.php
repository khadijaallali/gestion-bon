<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    .modern-navbar {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
        backdrop-filter: blur(20px);
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1.5rem;
        position: sticky;
        top: 0;
        z-index: 1000;
        min-height: 60px;
    }

    .navbar-brand-modern {
        color: white !important;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .navbar-brand-modern:hover {
        transform: translateY(-2px);
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .logo-container {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .menu-toggle-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .menu-toggle-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .nav-tabs-modern {
        border: none;
        gap: 4px;
        margin: 0;
    }

    .nav-link-modern {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white !important;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .nav-link-modern:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white !important;
    }

    .nav-link-modern.active {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 8px;
        margin-top: 8px;
    }

    .dropdown-item-modern {
        color: #2d3748;
        padding: 10px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dropdown-item-modern:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        color: #2d3748;
        transform: translateX(5px);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-name {
        color: white;
        font-weight: 500;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
    }

    .user-name:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-2px);
    }

    .logout-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238, 90, 82, 0.4);
        color: white;
    }

    .login-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .login-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
    }

    /* Sidebar moderne */
    .offcanvas-modern {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
        backdrop-filter: blur(20px);
        border: none;
    }

    .offcanvas-header-modern {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1.5rem;
    }

    .offcanvas-title-modern {
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .btn-close-modern {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        opacity: 1;
    }

    .sidebar-nav {
        padding: 1rem;
    }

    .sidebar-item {
        margin-bottom: 8px;
    }

    .sidebar-link {
        color: white;
        text-decoration: none;
        padding: 12px 16px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.1);
        margin-bottom: 4px;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateX(5px);
    }

    .sidebar-dropdown {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 8px;
        margin-top: 4px;
        position: static !important;
        transform: none !important;
        border: none;
        box-shadow: none;
        display: block;
        width: 100%;
    }

    .sidebar-dropdown-item {
        color: rgba(255, 255, 255, 0.9) !important;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 6px;
        display: flex !important;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        width: 100%;
        border: none;
        background: transparent;
    }

    .sidebar-dropdown-item:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        transform: translateX(3px);
    }

    .support-section {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.1);
    }

    .support-link {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .support-link:hover {
        color: rgba(255, 255, 255, 0.8);
        transform: translateX(3px);
    }

    @media (max-width: 768px) {
        .modern-navbar {
            padding: 0.4rem 1rem;
            min-height: 50px;
        }
        
        .nav-tabs-modern {
            flex-direction: column;
            gap: 2px;
        }
        
        .navbar-brand-modern {
            font-size: 1rem;
        }
        
        .nav-link-modern {
            padding: 4px 8px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Barre de navigation principale -->
<div class="modern-navbar d-flex justify-content-between align-items-center no-print">
    <!-- Bouton ☰ pour ouvrir le menu latéral -->
    <div class="d-flex align-items-center">
        @if(auth()->check() && auth()->user()->role === 'admin')
        <button class="menu-toggle-btn me-4 no-print" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <i class="fas fa-bars"></i>
        </button>
        @endif

        <!-- Logo + Titre -->
        <a class="navbar-brand-modern no-print" href="{{ url('/bons') }}">
            <div class="logo-container">
                <img src="{{ asset('images/image.png') }}" alt="Logo" style="width: 30px; height: 30px;">
            </div>
            <span>BonHub</span>
        </a>
    </div>

    <!-- Navigation horizontale -->
    <ul class="nav nav-tabs-modern d-flex">
        <li class="nav-item">
            <a class="nav-link-modern active no-print" href="/bons">
                <i class="fas fa-home"></i> Accueil
            </a>
        </li>
        <li class="nav-item no-print">
            <a class="nav-link-modern" href="/saisi">
                <i class="fas fa-plus-circle"></i> Ajouter un bon
            </a>
        </li>
                @if(auth()->check() && auth()->user()->role === 'admin')

        <li class="nav-item dropdown">
            <a class="nav-link-modern dropdown-toggle no-print" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fas fa-search"></i> Rechercher
            </a>
            <ul class="dropdown-menu dropdown-menu-modern">
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('recherche.matricule') }}">
                    <i class="fas fa-id-card"></i> Par N° matricule
                </a></li>
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('recherche.vehicule') }}">
                    <i class="fas fa-car"></i> Par N° véhicule
                </a></li> 
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('recherche.bon') }}">
                    <i class="fas fa-receipt"></i> Par N° bon
                </a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link-modern dropdown-toggle no-print" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fas fa-print"></i> Imprimer
            </a>
            <ul class="dropdown-menu dropdown-menu-modern">
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('impression.bon') }}">
                    <i class="fas fa-receipt"></i> Par bon
                </a></li>
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('impression.preneur') }}">
                    <i class="fas fa-user"></i> Par agent
                </a></li> 
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('impression.site') }}">
                    <i class="fas fa-map-marker-alt"></i> Par site
                </a></li>
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('impression.service') }}">
                    <i class="fas fa-briefcase"></i> Par service
                </a></li>
                <li><a class="dropdown-item dropdown-item-modern" href="{{ route('impression.vehicule') }}">
                    <i class="fas fa-car"></i> Par véhicule
                </a></li>
            </ul>
        </li>
        @endif
    </ul>

    <!-- Partie profil utilisateur -->
    <div class="user-profile no-print">
        @auth
            <a href="/profile" class="user-name no-print">
                <i class="fas fa-user-circle"></i>
                {{ Auth::user()->name }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn no-print" type="submit">
                    <i class="fas fa-sign-out-alt"></i> Se déconnecter
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="login-btn no-print">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </a>
        @endauth
    </div>
</div>

 @if(auth()->check() && auth()->user()->role === 'admin')
    <aside class="sidebar no-print">

<!-- Offcanvas Sidebar gauche -->
<div class="offcanvas offcanvas-start offcanvas-modern" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header offcanvas-header-modern">
    <h3 class="offcanvas-title offcanvas-title-modern" id="sidebarMenuLabel">
        <i class="fas fa-cogs"></i> Menu Administration
    </h3>
    <button type="button" class="btn-close btn-close-modern" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
  </div>
  <div class="offcanvas-body sidebar-nav">
    <ul class="navbar-nav">
        <li class="sidebar-item">
            <a class="sidebar-link" href="/bons">
                <i class="fas fa-home"></i> Accueil
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" data-bs-toggle="collapse" href="#sitesMenu" role="button" aria-expanded="false">
                <i class="fas fa-map-marker-alt"></i> Sites <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse sidebar-dropdown" id="sitesMenu">
                <a class="sidebar-dropdown-item" href="/sites/create">
                    <i class="fas fa-plus"></i> Ajouter site
                </a>
                <a class="sidebar-dropdown-item" href="/sites">
                    <i class="fas fa-list"></i> Gérer sites
                </a>
            </div>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" data-bs-toggle="collapse" href="#servicesMenu" role="button" aria-expanded="false">
                <i class="fas fa-briefcase"></i> Services <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse sidebar-dropdown" id="servicesMenu">
                <a class="sidebar-dropdown-item" href="/services/create">
                    <i class="fas fa-plus"></i> Ajouter service
                </a>
                <a class="sidebar-dropdown-item" href="/services">
                    <i class="fas fa-list"></i> Gérer services
                </a>
            </div>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" data-bs-toggle="collapse" href="#vehiculesMenu" role="button" aria-expanded="false">
                <i class="fas fa-car"></i> Véhicules <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse sidebar-dropdown" id="vehiculesMenu">
                <a class="sidebar-dropdown-item" href="/vehicules/create">
                    <i class="fas fa-plus"></i> Ajouter véhicule
                </a>
                <a class="sidebar-dropdown-item" href="/vehicules">
                    <i class="fas fa-list"></i> Gérer véhicules
                </a>
            </div>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" data-bs-toggle="collapse" href="#preneursMenu" role="button" aria-expanded="false">
                <i class="fas fa-users"></i> Preneurs <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse sidebar-dropdown" id="preneursMenu">
                <a class="sidebar-dropdown-item" href="/preneurs/create">
                    <i class="fas fa-plus"></i> Ajouter preneur
                </a>
                <a class="sidebar-dropdown-item" href="/preneurs">
                    <i class="fas fa-list"></i> Gérer preneurs
                </a>
            </div>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false">
                <i class="fas fa-user-cog"></i> Utilisateurs <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <div class="collapse sidebar-dropdown" id="usersMenu">
                <a class="sidebar-dropdown-item" href="/users/create">
                    <i class="fas fa-plus"></i> Ajouter utilisateur
                </a>
                <a class="sidebar-dropdown-item" href="/users">
                    <i class="fas fa-list"></i> Gérer utilisateurs
                </a>
            </div>
        </li>
    </ul>
    
    <div class="support-section">
        <a href="/support" class="support-link">
            <i class="fas fa-life-ring"></i> Aide et support
        </a>
    </div>
  </div>
</div>
</aside>
  @endif
