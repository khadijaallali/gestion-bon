@extends('layouts.app')

@section('title', 'Modifier la véhicule')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0">Modifier la véhicule</h2>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vehicules.update', $vehicule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="n_vehicule" class="form-label">numéro de la véhicule:</label>
                    <input type="text" name="n_vehicule" id="n_vehicule" class="form-control" value="{{ old('n_vehicule', $vehicule->n_vehicule) }}" required>
                </div>

                <div class="mb-3">
                    <label for="marque" class="form-label">Marque de la véhicule :</label>
                    <input type="text" name="marque" id="marque" class="form-control" value="{{ old('marque', $vehicule->marque) }}" required>
                </div>

                <div class="mb-3">
                    <label for="modele" class="form-label">Modèle de la véhicule :</label>
                    <input type="text" name="modele" id="modele" class="form-control" value="{{ old('modele', $vehicule->modele) }}" required> 
                </div>


                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
