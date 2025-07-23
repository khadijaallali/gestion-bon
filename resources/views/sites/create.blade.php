@extends('layouts.app')

@section('title', 'Ajouter un site')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('sites.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des sites
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-building"></i>
            </div>
            Ajouter un Site
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

        <form action="{{ route('sites.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code_site" class="form-label">
                    <i class="fas fa-code"></i> Code du site
                </label>
                <input type="text" 
                       name="code_site" 
                       id="code_site" 
                       value="{{ old('code_site') }}" 
                       class="form-control-modern" 
                       placeholder="Code site"
                       required>
            </div>

            <div class="form-group">
                <label for="nom_site" class="form-label">
                    <i class="fas fa-map-marker-alt"></i> Nom du site
                </label>
                <input type="text" 
                       name="nom_site" 
                       id="nom_site" 
                       value="{{ old('nom_site') }}" 
                       class="form-control-modern" 
                       placeholder="Nom site"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-plus"></i> Ajouter le site
                </button>
                <a href="{{ route('sites.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
