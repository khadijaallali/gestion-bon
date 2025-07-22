<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des bons</title>
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
<table>
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
    @php $total = 0; @endphp
    @foreach($bons as $bon)
        @php $total += $bon->total; @endphp
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
</body>
</html>
