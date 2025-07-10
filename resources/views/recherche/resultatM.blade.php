@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Résultats pour : <strong>{{ $matricule }}</strong></h4>

    @if ($bons->isEmpty())
        <div class="alert alert-warning mt-3">Aucun bon trouvé pour ce matricule.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                  <th>N° Bon</th>
                    <th>Véhicule</th>
                    <th>Preneur</th>
                    <th>Marque</th>
                    <th>Type de Carburant</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bons as $bon)
                    <tr>
                        <td>{{ $bon->n_bon }}</td>
                        <td>{{ $bon->vehicule->n_vehicule }}</td>
                        <td>{{ $bon->preneur->nom }}</td>
                        <td>{{ $bon->vehicule->marque }}</td>
                        <td>{{ $bon->type_carburant }}</td>
                        <td>{{ $bon->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
