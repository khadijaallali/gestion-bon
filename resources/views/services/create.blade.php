@extends('layouts.app')

@section('title', 'Ajouter un service')

@section('content')
@include('components.modern-form-style')

<div class="modern-form-container">
    <a href="{{ route('services.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour à la liste des services
    </a>
    
    <div class="form-header">
        <h1 class="form-title">
            <div class="form-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            Ajouter un Service
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

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code_service" class="form-label">
                    <i class="fas fa-code"></i> Code du service
                </label>
                <input type="text" 
                       name="code_service" 
                       id="code_service" 
                       value="{{ old('code_service') }}" 
                       class="form-control-modern" 
                       placeholder="code service"
                       required>
            </div>

            <div class="form-group">
                <label for="nom_service" class="form-label">
                    <i class="fas fa-tag"></i> Nom du service
                </label>
                <input type="text" 
                       name="nom_service" 
                       id="nom_service" 
                       value="{{ old('nom_service') }}" 
                       class="form-control-modern" 
                       placeholder="Nom service"
                       required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-plus"></i> Ajouter le service
                </button>
                <a href="{{ route('services.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
