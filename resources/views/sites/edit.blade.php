@extends('layouts.app')

@section('title', 'Modifier le site')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0">Modifier le site</h2>
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

            <form action="{{ route('sites.update', $site->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code_site" class="form-label">Code du site :</label>
                    <input type="text" name="code_site" id="code_site" class="form-control" value="{{ old('code_site', $site->code_site) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nom_site" class="form-label">Nom du site :</label>
                    <input type="text" name="nom_site" id="nom_site" class="form-control" value="{{ old('nom_site', $site->nom_site) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('sites.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
