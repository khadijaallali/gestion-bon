@extends('layouts.app')

@section('title', 'Liste des utilisateurs ')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Liste des utilisateus </h2>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($users->isEmpty())
                <div class="alert alert-warning">Aucun utilisateur trouvé.</div>
            @else
                <ul class="list-group">
                    @foreach($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $user->id }}</strong>- {{ $user->name }} - {{ $user->email }} -{{ $user->role }}
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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
