@extends('layouts.app')

@section('title', 'Liste des sites')

@section('content')
@include('components.modern-page-style')

<div class="modern-container">
    <div class="modern-header">
        <h1 class="modern-title">Gestion des Sites</h1>
    </div>
    
    <a href="{{ route('sites.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un nouveau site
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
                <i class="fas fa-building"></i> Liste des Sites
            </h2>
        </div>
        <div class="modern-card-body">
            @if($sites->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Aucun site trouvé</h3>
                    <p>Commencez par ajouter votre premier site.</p>
                </div>
            @else
                <ul class="modern-list">
                    @foreach($sites as $site)
                        <li class="modern-list-item">
                            <div class="item-content">
                                <div class="item-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="item-details">
                                    <h5>{{ $site->nom_site }}</h5>
                                    <p>Code: {{ $site->code_site }} | ID: {{ $site->id }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="action-buttons">
                                <a href="{{ route('sites.edit', $site->id) }}" class="modern-btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('sites.destroy', $site->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce site ?');">
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
