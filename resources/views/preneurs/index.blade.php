@extends('layouts.app')

@section('title', 'Liste des preneurs')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Liste des preneurs</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($preneurs->isEmpty())
                <div class="alert alert-warning">Aucun preneur trouvé.</div>
            @else
                <ul class="list-group">
                    @foreach($preneurs as $preneur)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $preneur->id }}</strong> - {{$preneur->n_matricule }}- {{ $preneur->nom }}
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('preneurs.edit', $preneur->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('preneurs.destroy', $preneur->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
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
