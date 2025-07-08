@extends('layouts.app')

@section('title', 'Ajouter un preneur')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Ajouter un preneur</h2>
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

            <form action="{{ route('preneurs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="n_matricule" class="form-label">N° du matricule</label>
                    <input type="text" name="n_matricule" id="n_matricule" value="{{ old('n_matricule') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du preneur</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('preneurs.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
