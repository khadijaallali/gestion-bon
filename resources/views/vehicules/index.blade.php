@extends('layouts.app')

@section('title', 'Liste des vehiucules')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Liste des véhicules</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($vehicules->isEmpty())
                <div class="alert alert-warning">Aucune véhicule trouvé.</div>
            @else
                <ul class="list-group">
                    @foreach($vehicules as $vehicule)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $vehicule->id }}</strong>- {{$vehicule->n_vehicule}} - {{$vehicule->marque }} - {{ $vehicule-> modele}}
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
