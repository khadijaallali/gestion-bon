@extends('layouts.app')

@section('title', 'Modifier le preneur')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('preneurs.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des preneurs
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-edit"></i>
            </div>
            Modifier le Preneur
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

        <form action="{{ route('preneurs.update', $preneur->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="n_matricule" class="form-label">
                    <i class="fas fa-id-card"></i> N° du matricule
                </label>
                <input type="text" 
                       name="n_matricule" 
                       id="n_matricule" 
                       value="{{ old('n_matricule', $preneur->n_matricule) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: MAT001"
                       required>
            </div>

            <div class="form-group">
                <label for="nom" class="form-label">
                    <i class="fas fa-user-tag"></i> Nom du preneur
                </label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       value="{{ old('nom', $preneur->nom) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: Dupont Jean"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('preneurs.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
