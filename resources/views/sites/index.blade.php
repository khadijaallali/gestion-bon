@extends('layouts.app')

@section('title', 'Liste des sites')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Liste des sites</h2>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($sites->isEmpty())
                <div class="alert alert-warning">Aucun site trouvé.</div>
            @else
                <ul class="list-group">
                    @foreach($sites as $site)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $site->id }}</strong>- {{ $site->code_site }} - {{ $site->nom_site }}
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('sites.destroy', $site->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
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
