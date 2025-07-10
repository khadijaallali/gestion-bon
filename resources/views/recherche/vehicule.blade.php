@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>🔍 Recherche par N° Vehicule</h3>

    <form action="{{ route('resultatV.vehicule') }}" method="GET" class="mt-3">
        <div class="mb-3">
            <label for="vehicule" class="form-label">Numéro de véhicule :</label>
            <input type="text" name="vehicule" id="vehicule" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>
@endsection
