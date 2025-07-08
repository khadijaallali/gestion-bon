@extends('layouts.app')

@section('title', 'Liste des services')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Liste des services</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($services->isEmpty())
                <div class="alert alert-warning">Aucun service trouvé.</div>
            @else
                <ul class="list-group">
                    @foreach($services as $service)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $service->code_service }}</strong> - {{ $service->nom_service }}
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
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
