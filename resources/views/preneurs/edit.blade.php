@extends('layouts.app')

@section('title', 'Modifier le preneur')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0">Modifier le preneur</h2>
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

            <form action="{{ route('preneurs.update', $preneur->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="n_matricule" class="form-label">N° du matricule :</label>
                    <input type="text" name="n_matricule" id="n_matricule" class="form-control" value="{{ old('n_matricule', $preneur->n_matricule) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du preneur :</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $preneur->nom) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('preneurs.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
