@extends('layouts.app')

@section('title', 'Liste des véhicules')

@section('content')
@include('components.modern-page-style')

<div class="modern-container">
    <div class="modern-header">
        <h1 class="modern-title">Gestion des Véhicules</h1>
    </div>
    
    <a href="{{ route('vehicules.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un nouveau véhicule
    </a>

    @if (session('success'))
        <div class="modern-alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="modern-card">
        <div class="modern-card-header">
            <h2 class="modern-card-title">
                <i class="fas fa-car"></i> Liste des Véhicules
            </h2>
        </div>
        <div class="modern-card-body">
            @if($vehicules->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-car"></i>
                    <h3>Aucun véhicule trouvé</h3>
                    <p>Commencez par ajouter votre premier véhicule.</p>
                </div>
            @else
                <ul class="modern-list">
                    @foreach($vehicules as $vehicule)
                        <li class="modern-list-item">
                            <div class="item-content">
                                <div class="item-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="item-details">
                                    <h5>{{ $vehicule->n_vehicule }}</h5>
                                    <p>{{ $vehicule->marque }} {{ $vehicule->modele }} | ID: {{ $vehicule->id }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="action-buttons">
                                <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="modern-btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce véhicule ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="modern-btn btn-delete">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
