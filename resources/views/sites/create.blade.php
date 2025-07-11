@extends('layouts.app')

@section('title', 'Ajouter un site')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Ajouter un site</h3>
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

            <form action="{{ route('sites.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="code_site" class="form-label">Code du site :</label>
                    <input type="text" name="code_site" id="code_site" 
                           class="form-control" value="{{ old('code_site') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nom_site" class="form-label">Nom du site :</label>
                    <input type="text" name="nom_site" id="nom_site" 
                           class="form-control" value="{{ old('nom_site') }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
