@extends('layouts.app')

@section('title', 'Modifier le site')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('sites.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des sites
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-edit"></i>
            </div>
            Modifier le Site
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

        <form action="{{ route('sites.update', $site->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code_site" class="form-label">
                    <i class="fas fa-code"></i> Code du site
                </label>
                <input type="text" 
                       name="code_site" 
                       id="code_site" 
                       value="{{ old('code_site', $site->code_site) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: SITE001"
                       required>
            </div>

            <div class="form-group">
                <label for="nom_site" class="form-label">
                    <i class="fas fa-map-marker-alt"></i> Nom du site
                </label>
                <input type="text" 
                       name="nom_site" 
                       id="nom_site" 
                       value="{{ old('nom_site', $site->nom_site) }}" 
                       class="form-control-modern" 
                       placeholder="Ex: Site Principal"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('sites.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
