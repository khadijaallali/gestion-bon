@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="only-print text-center mb-4">
        <h2><strong>AUTO HALL</strong></h2>
        <p>Zone Industrielle, Casablanca – Maroc <br>
           Tél : +212 5 22 00 00 00 | Email : contact@autohall.ma</p>
        <hr>
    </div>

    <h1 class="mb-3 text-center">Récapitulatif par site</h1>

    @if($date_debut && $date_fin)
        <p class="text-center">Période : {{ $date_debut }} au {{ $date_fin }}</p>
    @endif

    <a href="{{ route('impression.sites.pdf', ['date_debut' => $date_debut, 'date_fin' => $date_fin]) }}" class="btn btn-primary text-center mb-3 my-2" target="_blank">
    🖨️ Imprimer Le rapport
</a>

    <table class="table table-bordered table-striped">
        <thead class="table-secondary text-center">
            <tr>
                <th>Code site</th>
                <th>Nom site</th>
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
                $total_montant_essence = 0;
                $total_montant_diesel = 0;
            @endphp

            @foreach($recap as $row)
                @php
                    $montant_total = $row['montant_essence'] + $row['montant_diesel'];
                    $total_essence += $row['essence_l'];
                    $total_diesel += $row['diesel_l'];
                    $total_montant_essence += $row['montant_essence'];
                    $total_montant_diesel += $row['montant_diesel'];
                @endphp
                <tr class="text-center">
                    <td>{{ $row['code_site'] }}</td>
                    <td>{{ $row['nom_site'] }}</td>
                    <td>{{ number_format($row['essence_l'], 2, ',', ' ') }}</td>
                    <td>{{ number_format($row['diesel_l'], 2, ',', ' ') }}</td>
                    <td>{{ number_format($row['montant_essence'], 2, ',', ' ') }}</td>
                    <td>{{ number_format($row['montant_diesel'], 2, ',', ' ') }}</td>
                    <td>{{ number_format($montant_total, 2, ',', ' ') }}</td>
                </tr>
            @endforeach

            <tr class="table-success fw-bold text-center">
                <td colspan="2">TOTAL GÉNÉRAL</td>
                <td>{{ number_format($total_essence, 2, ',', ' ') }}</td>
                <td>{{ number_format($total_diesel, 2, ',', ' ') }}</td>
                <td>{{ number_format($total_montant_essence, 2, ',', ' ') }}</td>
                <td>{{ number_format($total_montant_diesel, 2, ',', ' ') }}</td>
                <td>{{ number_format($total_montant_essence + $total_montant_diesel, 2, ',', ' ') }}</td>
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
