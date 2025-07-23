@extends('layouts.app')

@section('title', 'Recherche par véhicule')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ url('/bons') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à l'accueil
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-car"></i>
            </div>
            Recherche par N° Véhicule
        </h1>
        <p class="form-subtitle">Recherchez des bons de carburant par numéro de véhicule</p>
    </div>

    <div class="modern-form">
        <form action="{{ route('resultatV.vehicule') }}" method="GET">
            <div class="form-group">
                <label for="vehicule" class="form-label">
                    <i class="fas fa-hashtag"></i> Numéro de véhicule
                </label>
                <input type="text" 
                       name="vehicule" 
                       id="vehicule" 
                       class="form-control-modern" 
                       placeholder="Ex: 00012/C/12"
                       value="{{ request('vehicule') }}"
                       required>
                <small class="form-help">Saisissez le numéro d'immatriculation du véhicule</small>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-search"></i> Lancer la recherche
                </button>
                <button type="reset" class="btn-modern btn-secondary-modern" onclick="document.getElementById('vehicule').value='';">
                    <i class="fas fa-eraser"></i> Effacer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.form-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
    margin-top: 0.5rem;
    text-align: center;
}

.form-help {
    display: block;
    margin-top: 0.5rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.875rem;
}
</style>
@endsection
