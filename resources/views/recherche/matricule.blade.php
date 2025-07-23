@extends('layouts.app')

@section('title', 'Recherche par matricule')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ url('/bons') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à l'accueil
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-search"></i>
            </div>
            Recherche par N° Matricule
        </h1>
        <p class="form-subtitle">Recherchez des bons de carburant par numéro de matricule</p>
    </div>

    <div class="modern-form">
        <form action="{{ route('resultatM.matricule') }}" method="GET">
            <div class="form-group">
                <label for="matricule" class="form-label">
                    <i class="fas fa-id-card"></i> Numéro de matricule
                </label>
                <input type="text" 
                       name="matricule" 
                       id="matricule" 
                       class="form-control-modern" 
                       placeholder="Ex: 109999"
                       value="{{ request('matricule') }}"
                       required>
                <small class="form-help">Saisissez le numéro de matricule du preneur</small>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-search"></i> Lancer la recherche
                </button>
                <button type="reset" class="btn-modern btn-secondary-modern" onclick="document.getElementById('matricule').value='';">
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
