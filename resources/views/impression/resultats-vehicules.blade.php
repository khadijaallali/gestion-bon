@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1 class="mb-3 text-center">Récapitulatif par Vehicule</h1>

    @if($date_debut && $date_fin)
        <p class="text-center">Période : {{ $date_debut }} au {{ $date_fin }}</p>
    @endif

    <a href="{{ route('impression.vehicules.pdf', ['date_debut' => $date_debut, 'date_fin' => $date_fin]) }}" class="btn btn-primary text-center mb-3 my-2" target="_blank">
    <i class="fas fa-print"></i> Imprimer
    </a>
    
        <!--<div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-primary mb-3 my-2">🖨️ Imprimer le rapport</button>
        </div>-->

    <table class="table table-bordered">
        <thead class="table-secondary text-center">
            <tr>
                <th>Numéro</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Preneur</th>
                <th>Essence (L)</th>
                <th>Diesel (L)</th>
                <th>Montant essence (DH)</th>
                <th>Montant diesel (DH)</th>
                <th>Montant total (DH)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_essence = 0;
                $total_diesel = 0;
                $montant_essence = 0;
                $montant_diesel = 0;
                $montant_total = 0;
            @endphp

            @foreach($recap as $row)
                @php
                    $total_essence += $row['essence_l'];
                    $total_diesel += $row['diesel_l'];
                    $montant_essence += $row['montant_essence'];
                    $montant_diesel += $row['montant_diesel'];
                    $montant_total += $row['montant_total'];
                @endphp
                <tr>
                    <td>{{ $row['numero'] }}</td>
                    <td>{{ $row['marque'] }}</td>
                    <td>{{ $row['modele'] }}</td>
                    <td>{{ $row['preneur'] }}</td>
                    <td class="text-end">{{ number_format($row['essence_l'], 2, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($row['diesel_l'], 2, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($row['montant_essence'], 2, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($row['montant_diesel'], 2, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($row['montant_total'], 2, ',', ' ') }}</td>
                </tr>
            @endforeach

            <tr class="table-success fw-bold text-center">
                <td colspan="4">TOTAL GÉNÉRAL</td>
                <td class="text-end">{{ number_format($total_essence, 2, ',', ' ') }} L</td>
                <td class="text-end">{{ number_format($total_diesel, 2, ',', ' ') }} L</td>
                <td class="text-end">{{ number_format($montant_essence, 2, ',', ' ') }} DH</td>
                <td class="text-end">{{ number_format($montant_diesel, 2, ',', ' ') }} DH</td>
                <td class="text-end">{{ number_format($montant_total, 2, ',', ' ') }} DH</td>
            </tr>
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

    /* Masquer navbar, sidebar et alert à l'impression */
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
