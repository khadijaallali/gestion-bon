@extends('layouts.app')

@section('title', 'Recherche par bon')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ url('/bons') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à l'accueil
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-receipt"></i>
            </div>
            Recherche par N° Bon
        </h1>
        <p class="form-subtitle">Recherchez un bon de carburant par son numéro</p>
    </div>

    <div class="modern-form">
        <form action="{{ route('resultatB.bon') }}" method="GET">
            <div class="form-group">
                <label for="bon" class="form-label">
                    <i class="fas fa-barcode"></i> Numéro de bon
                </label>
                <input type="text" 
                       name="bon" 
                       id="bon" 
                       class="form-control-modern" 
                       placeholder="Ex: 123456"
                       value="{{ request('bon') }}"
                       required>
                <small class="form-help">Saisissez le numéro unique du bon de carburant</small>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-search"></i> Lancer la recherche
                </button>
                <button type="reset" class="btn-modern btn-secondary-modern" onclick="document.getElementById('bon').value='';">
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
