@extends('layouts.app')

@section('title', 'Ajouter un service')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Ajouter un service</h2>
        </div>
        <div class="card-body">
            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('services.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="code_service" class="form-label">Code du service</label>
                    <input type="text" name="code_service" id="code_service" value="{{ old('code_service') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nom_service" class="form-label">Nom du service</label>
                    <input type="text" name="nom_service" id="nom_service" value="{{ old('nom_service') }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
