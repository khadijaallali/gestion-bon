@extends('layouts.app')

@section('title', 'Liste des services')

@section('content')
@include('components.modern-page-style')

<div class="modern-container">
    <div class="modern-header">
        <h1 class="modern-title">Gestion des Services</h1>
    </div>
    
    <a href="{{ route('services.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un nouveau service
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
                <i class="fas fa-briefcase"></i> Liste des Services
            </h2>
        </div>
        <div class="modern-card-body">
            @if($services->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-briefcase"></i>
                    <h3>Aucun service trouvé</h3>
                    <p>Commencez par ajouter votre premier service.</p>
                </div>
            @else
                <ul class="modern-list">
                    @foreach($services as $service)
                        <li class="modern-list-item">
                            <div class="item-content">
                                <div class="item-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="item-details">
                                    <h5>{{ $service->nom_service }}</h5>
                                    <p>Code: {{ $service->code_service }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="action-buttons">
                                <a href="{{ route('services.edit', $service->id) }}" class="modern-btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?');">
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
