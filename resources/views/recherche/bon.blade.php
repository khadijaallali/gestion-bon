@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>🔍 Recherche par N° bon</h3>

    <form action="{{ route('resultatB.bon') }}" method="GET" class="mt-3">
        <div class="mb-3">
            <label for="bon" class="form-label">Numéro de bon :</label>
            <input type="text" name="bon" id="bon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>
@endsection
