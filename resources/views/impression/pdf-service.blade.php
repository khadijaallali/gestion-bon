<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif par Service</title>
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
<h1>Récapitulatif par service</h1>
<p class="text-center">Période : {{ $date_debut }} au {{ $date_fin }}</p>
<table>
    <thead>
        <tr>
            <th>Service</th>
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
            <td>{{ $row['service'] }}</td>
            <td style="text-align:right">{{ number_format($row['essence_l'], 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($row['diesel_l'], 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($row['montant_essence'], 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($row['montant_diesel'], 2, ',', ' ') }}</td>
            <td style="text-align:right">{{ number_format($row['montant_total'], 2, ',', ' ') }}</td>
        </tr>
    @endforeach
    <tr style="font-weight:bold;background:#e0ffe0;text-align:center">
        <td>TOTAL GÉNÉRAL</td>
        <td style="text-align:right">{{ number_format($total_essence, 2, ',', ' ') }} L</td>
        <td style="text-align:right">{{ number_format($total_diesel, 2, ',', ' ') }} L</td>
        <td style="text-align:right">{{ number_format($montant_essence, 2, ',', ' ') }} DH</td>
        <td style="text-align:right">{{ number_format($montant_diesel, 2, ',', ' ') }} DH</td>
        <td style="text-align:right">{{ number_format($montant_total, 2, ',', ' ') }} DH</td>
    </tr>
    </tbody>
</table>
</body>
</html>
