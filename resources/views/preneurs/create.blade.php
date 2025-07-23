@extends('layouts.app')

@section('title', 'Ajouter un preneur')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('preneurs.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des preneurs
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-user"></i>
            </div>
            Ajouter un Preneur
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

        <form action="{{ route('preneurs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="n_matricule" class="form-label">
                    <i class="fas fa-id-card"></i> N° du matricule
                </label>
                <input type="text" 
                       name="n_matricule" 
                       id="n_matricule" 
                       value="{{ old('n_matricule') }}" 
                       class="form-control-modern" 
                       placeholder="Numéro de matricule"
                       required>
            </div>

            <div class="form-group">
                <label for="nom" class="form-label">
                    <i class="fas fa-user-tag"></i> Nom du preneur
                </label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       value="{{ old('nom') }}" 
                       class="form-control-modern" 
                       placeholder="Nom d'agent"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-plus"></i> Ajouter le preneur
                </button>
                <a href="{{ route('preneurs.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
