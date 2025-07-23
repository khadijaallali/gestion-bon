@extends('layouts.app')

@section('title', 'Ajouter un utilisateur')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des utilisateurs
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            Ajouter un Utilisateur
        </h1>
    </div>

    <div class="modern-form">
        @if ($errors->any())
            <div class="modern-alert alert-danger-modern">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Erreurs de validation :</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> Nom
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}" 
                       class="form-control-modern" 
                       placeholder="Nom utilisateur"
                       required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}" 
                       class="form-control-modern" 
                       placeholder="Email utilisateur"
                       required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">
                    <i class="fas fa-user-tag"></i> Rôle
                </label>
                <select name="role" id="role" class="form-control-modern" required>
                    <option value="">Sélectionner un rôle</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="form-control-modern" 
                       placeholder="Saisir le mot de passe"
                       required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock"></i> Confirmer le mot de passe
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       class="form-control-modern" 
                       placeholder="Confirmer le mot de passe"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-plus"></i> Ajouter l'utilisateur
                </button>
                <a href="{{ route('users.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
