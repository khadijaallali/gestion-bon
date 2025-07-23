@extends('layouts.app')

@section('title', "Modifier l'utilisateur")

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des utilisateurs
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-edit"></i>
            </div>
            Modifier l'Utilisateur
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

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> Nom d'utilisateur
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $user->name) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: Jean Dupont"
                       required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email', $user->email) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: jean.dupont@example.com"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('users.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
