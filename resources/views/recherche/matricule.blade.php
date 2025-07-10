@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>🔍 Recherche par N° matricule</h3>

    <form action="{{ route('resultatM.matricule') }}" method="GET" class="mt-3">
        <div class="mb-3">
            <label for="matricule" class="form-label">Numéro de matricule :</label>
            <input type="text" name="matricule" id="matricule" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>
@endsection
