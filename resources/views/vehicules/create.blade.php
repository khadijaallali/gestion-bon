@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('title', 'Ajouter une véhicule')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Ajouter une véhicule</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vehicules.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="n_vehicule" class="form-label">Numéro de la véhicule:</label>
                    <input type="text" name="n_vehicule" id="n_vehicule" 
                           class="form-control" value="{{ old('n_vehicule') }}" required>
                </div>

                <div class="mb-3">
                    <label for="marque" class="form-label">Marque de véhicule :</label>
                    <input type="text" name="marque" id="marque" 
                           class="form-control" value="{{ old('marque') }}" required>
                </div>
                <div class="mb-3">
                    <label for="modele" class="form-label">Modèle de véhicule :</label>
                    <input type="text" name="modele" id="modele" 
                           class="form-control" value="{{ old('modele') }}" required>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
