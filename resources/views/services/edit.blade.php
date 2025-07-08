@extends('layouts.app')

@section('title', 'Modifier le service')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0">Modifier le service</h2>
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

            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code_service" class="form-label">Code du service :</label>
                    <input type="text" name="code_service" id="code_service" class="form-control" value="{{ old('code_service', $service->code_service) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nom_service" class="form-label">Nom du service :</label>
                    <input type="text" name="nom_service" id="nom_service" class="form-control" value="{{ old('nom_service', $service->nom_service) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
