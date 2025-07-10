@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Résultats pour : <strong>{{ $vehicule}}</strong></h4>

    @if ($bons->isEmpty())
        <div class="alert alert-warning mt-3">Aucun bon trouvé pour cette véhicule.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                   <th>N° Bon</th>
        <th>Quantité</th>
        <th>Prix</th>
        <th>Total</th>
        <th>Type Carburant</th>
        <th>Site</th>
        <th>Service</th>
        <th>Véhicule</th>
        <th>Preneur</th>
        <th>Date Bon</th>
        <th>Date Saisie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bons as $bon)
                    <tr>
                        <td>{{ $bon->n_bon }}</td>
            <td>{{ $bon->quantite }}</td>
            <td>{{ $bon->prix }}</td>
            <td>{{ $bon->total }}</td>
            <td>{{ $bon->type_carburant }}</td>
            <td>{{ $bon->site->nom_site ?? '' }}</td>
            <td>{{ $bon->service->nom_service ?? '' }}</td>
            <td>{{ $bon->vehicule->n_vehicule ?? '' }}</td>
            <td>{{ $bon->preneur->nom ?? '' }}</td>
            <td>{{ $bon->date_bon }}</td>
            <td>{{ $bon->date_saisie }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
