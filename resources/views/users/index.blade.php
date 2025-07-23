@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')
@include('components.modern-page-style')

<div class="modern-container">
    <div class="modern-header">
        <h1 class="modern-title">Gestion des Utilisateurs</h1>
    </div>
    
    <a href="{{ route('users.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un nouvel utilisateur
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
                <i class="fas fa-users"></i> Liste des Utilisateurs
            </h2>
        </div>
        <div class="modern-card-body">
            @if($users->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h3>Aucun utilisateur trouvé</h3>
                    <p>Commencez par ajouter votre premier utilisateur.</p>
                </div>
            @else
                <ul class="modern-list">
                    @foreach($users as $user)
                        <li class="modern-list-item">
                            <div class="item-content">
                                <div class="item-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="item-details">
                                    <h5>{{ $user->name }}</h5>
                                    <p>{{ $user->email }} | Rôle: {{ $user->role }} | ID: {{ $user->id }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="action-buttons">
                                <a href="{{ route('users.edit', $user->id) }}" class="modern-btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
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
