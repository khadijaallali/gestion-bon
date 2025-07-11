<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Impression des Bons</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
@media print {
  .no-print {
    display: none !important;
  }
}
</style>

</head>
<body>

    <div class="header text-center mb-5 mt-4 ">
        <h2><strong>AUTO HALL</strong></h2>
        <div class="contact">
            Adresse : Zone Industrielle, Casablanca – Maroc <br>
            Tél : +212 5 22 00 00 00 | Email : contact@autohall.ma
        </div>
    </div>

    <h5> Liste des bons :</h5>


    <div class="d-flex justify-content-end mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary no-print ">Imprimer</button>
        <a href="{{ route('bons.index') }}" class="btn btn-secondary no-print">Retour</a>
    </div>

    @if ($bons->isEmpty())
        <div class="alert alert-warning mt-4">Aucun bon trouvé pour ce matricule.</div>
    @else
        <table class="table table-bordered mt-4">
            <thead class="table-light">
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
    <div class="footer mt-4">
        <p>© 2023 AUTO HALL. Tous droits réservés.</p>  
    </div>
</body>
</html>
