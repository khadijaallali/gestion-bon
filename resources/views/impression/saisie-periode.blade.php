@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="only-print text-center mb-4">
        <h2><strong>AUTO HALL</strong></h2>
        <p>Zone Industrielle, Casablanca – Maroc <br>
           Tél : +212 5 22 00 00 00 | Email : contact@autohall.ma</p>
        <hr>
    </div>

    <h1 class="mb-3 text-center">Récapitulatif par service</h1>

    @if($date_debut && $date_fin)
        <p class="text-center">Période : {{ $date_debut }} au {{ $date_fin }}</p>
    @endif

    <div class="text-center no-print">
        <button onclick="window.print()" class="btn btn-primary mb-3 my-5">🖨️ Imprimer le rapport</button>
    </div>

        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>N° Bon</th>
                    <th>Date</th>
                    <th>Site</th>
                    <th>Service</th>
                    <th>Véhicule</th>
                    <th>Preneur</th>
                    <th>Type Carburant</th>
                    <th>Quantité (L)</th>
                    <th>Prix (DH)</th>
                    <th>Total (DH)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bons as $bon)
                    <tr>
                        <td>{{ $bon->n_bon }}</td>
                        <td>{{ $bon->date_bon }}</td>
                        <td>{{ $bon->site->nom_site ?? '' }}</td>
                        <td>{{ $bon->service->nom_service ?? '' }}</td>
                        <td>{{ $bon->vehicule->n_vehicule ?? '' }}</td>
                         <td>{{ $bon->preneur->nom ?? '' }}</td>
                        <td>{{ ucfirst($bon->type_carburant) }}</td>
                        <td>{{ $bon->quantite }}</td>
                        <td>{{ number_format($bon->prix, 2, ',', ' ') }}</td>
                        <td>{{ number_format($bon->total, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>

@endsection

<style>
@media print {
    .no-print {
        display: none !important;
    }

    .only-print {
        display: block !important;
    }

    .navbar, .sidebar, .alert {
        display: none !important;
    }

    body {
        background: white !important;
    }

    table {
        font-size: 12pt;
    }
}

@media screen {
    .only-print {
        display: none !important;
    }
}
</style>
