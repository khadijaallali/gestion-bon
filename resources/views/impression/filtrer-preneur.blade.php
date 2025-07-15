@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Filtrer par agent (preneur)</h3>
    <form action="{{ route('impression.preneurs.results') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-4">
            <label>Date début</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Date fin</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Afficher</button>
        </div>
    </form>
</div>
@endsection
