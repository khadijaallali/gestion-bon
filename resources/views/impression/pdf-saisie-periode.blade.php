<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des bons par période</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 18px;
            margin-top: 18px;
        }
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px 6px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
<div class="header">
    <h2><strong>AUTO HALL</strong></h2>
    <div class="contact">
        Adresse : Zone Industrielle, Casablanca – Maroc <br>
        Tél : +212 5 22 00 00 00 | Email : contact@autohall.ma
    </div>
</div>
<hr>
<h1>Liste des bons</h1>
<p class="text-center">Période : {{ $date_debut }} au {{ $date_fin }}</p>
<table>
    <thead>
        <tr>
            <th>N° Bon</th>
            <th>Date</th>
            <th>Site</th>
            <th>Service</th>
            <th>Véhicule</th>
            <th>Preneur</th>
            <th>Type</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    @php
        $total = 0;
    @endphp
    @foreach($bons as $bon)
        @php $total += $bon->total; @endphp
        <tr>
            <td>{{ $bon->n_bon }}</td>
            <td>{{ $bon->date_bon }}</td>
            <td>{{ $bon->site->nom_site ?? '' }}</td>
            <td>{{ $bon->service->nom_service ?? '' }}</td>
            <td>{{ $bon->vehicule->n_vehicule ?? '' }}</td>
            <td>{{ $bon->preneur->nom ?? '' }}</td>
            <td>{{ ucfirst($bon->type_carburant) }}</td>
            <td style="text-align:right">{{ number_format($bon->quantite, 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($bon->prix, 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($bon->total, 2, ',', ' ') }}</td>
        </tr>
    @endforeach
    <tr style="font-weight:bold;background:#e0ffe0;text-align:center">
        <td colspan="9">TOTAL GÉNÉRAL</td>
        <td style="text-align:right">{{ number_format($total, 2, ',', ' ') }} DH</td>
    </tr>
    </tbody>
</table>
</body>
</html>
