@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Filtrer par site</h2>
    <form action="{{ route('impression.site.result') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label for="date_debut" class="form-label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" required>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Afficher les résultats</button>
        </div>
    </form>
</div>
@endsection

