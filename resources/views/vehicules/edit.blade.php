@extends('layouts.app')

@section('title', 'Modifier le véhicule')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('vehicules.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des véhicules
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-edit"></i>
            </div>
            Modifier le Véhicule
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

        <form action="{{ route('vehicules.update', $vehicule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="n_vehicule" class="form-label">
                    <i class="fas fa-hashtag"></i> Numéro du véhicule
                </label>
                <input type="text" 
                       name="n_vehicule" 
                       id="n_vehicule" 
                       value="{{ old('n_vehicule', $vehicule->n_vehicule) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: VH001"
                       required>
            </div>

            <div class="form-group">
                <label for="marque" class="form-label">
                    <i class="fas fa-industry"></i> Marque du véhicule
                </label>
                <input type="text" 
                       name="marque" 
                       id="marque" 
                       value="{{ old('marque', $vehicule->marque) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: Toyota"
                       required>
            </div>

            <div class="form-group">
                <label for="modele" class="form-label">
                    <i class="fas fa-car-side"></i> Modèle du véhicule
                </label>
                <input type="text" 
                       name="modele" 
                       id="modele" 
                       value="{{ old('modele', $vehicule->modele) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: Corolla"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('vehicules.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
