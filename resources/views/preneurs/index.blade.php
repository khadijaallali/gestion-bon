@extends('layouts.app')

@section('title', 'Liste des preneurs')

@section('content')
@include('components.modern-page-style')

<div class="modern-container">
    <div class="modern-header">
        <h1 class="modern-title">Gestion des Preneurs</h1>
    </div>
    
    <a href="{{ route('preneurs.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un nouveau preneur
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
                <i class="fas fa-users"></i> Liste des Preneurs
            </h2>
        </div>
        <div class="modern-card-body">
            @if($preneurs->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h3>Aucun preneur trouvé</h3>
                    <p>Commencez par ajouter votre premier preneur.</p>
                </div>
            @else
                <ul class="modern-list">
                    @foreach($preneurs as $preneur)
                        <li class="modern-list-item">
                            <div class="item-content">
                                <div class="item-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="item-details">
                                    <h5>{{ $preneur->nom }}</h5>
                                    <p>Matricule: {{ $preneur->n_matricule }} | ID: {{ $preneur->id }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="action-buttons">
                                <a href="{{ route('preneurs.edit', $preneur->id) }}" class="modern-btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('preneurs.destroy', $preneur->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce preneur ?');">
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
