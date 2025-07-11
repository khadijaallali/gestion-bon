@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Résultats pour : <strong>{{ $bon }}</strong></h4>
    <a href="{{ route('bons.printB', ['bon' => $bon]) }}" class="btn btn-secondary" target="_blank">
        🖨️ Imprimer les résultats
    </a>    
    @if ($bons->isEmpty())
        <div class="alert alert-warning mt-3">Aucun bon trouvé pour ce numéro .</div>
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
                @foreach ($bons as $b)
                    <tr>
            <td>{{ $b->n_bon }}</td>
            <td>{{ $b->quantite }}</td>
            <td>{{ $b->prix }}</td>
            <td>{{ $b->total }}</td>
            <td>{{ $b->type_carburant }}</td>
            <td>{{ $b->site->nom_site ?? '' }}</td>
            <td>{{ $b->service->nom_service ?? '' }}</td>
            <td>{{ $b->vehicule->n_vehicule ?? '' }}</td>
            <td>{{ $b->preneur->nom ?? '' }}</td>
            <td>{{ $b->date_bon }}</td>
            <td>{{ $b->date_saisie }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
