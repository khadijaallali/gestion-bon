@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Créer un Bon de Carburant</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('bons.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label for="n_bon" class="form-label">N° Bon</label>
                <input type="text" class="form-control" id="n_bon" name="n_bon" required>
            </div>
            <div class="col">
                <label for="type_carburant" class="form-label">Type Carburant</label>
                <select class="form-select" name="type_carburant" required>
                    <option value="">-- Choisir --</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Essence">Essence</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="quantite" class="form-label">Quantité (L)</label>
                <input type="number" step="0.01" class="form-control" id="quantite" name="quantite" min="0"required>
            </div>
            <div class="col">
                <label for="prix" class="form-label">Prix (Dh)</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" min="0" required>
            </div>
            <div class="col">
                <label for="total" class="form-label">Total (Dh)</label>
                <input type="number" class="form-control" id="total" name="total" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="site_id" class="form-label">Site</label>
                <select class="form-select" name="site_id" required>
                    <option value="">-- Choisir un site --</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->nom_site }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="service_id" class="form-label">Service</label>
                <select class="form-select" name="service_id" required>
                    <option value="">-- Choisir un service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="vehicule_id" class="form-label">Véhicule</label>
                <select class="form-select" name="vehicule_id" required>
                    <option value="">-- Choisir un véhicule --</option>
                    @foreach($vehicules as $vehicule)
                        <option value="{{ $vehicule->id }}">{{ $vehicule->n_vehicule }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="preneur_id" class="form-label">Preneur</label>
                <select class="form-select" name="preneur_id" required>
                    <option value="">-- Choisir un preneur --</option>
                    @foreach($preneurs as $preneur)
                        <option value="{{ $preneur->id }}">{{ $preneur->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="date_bon" class="form-label">Date du Bon</label>
                <input type="date" class="form-control" name="date_bon" required>
            </div>
            <div class="col">
                <label for="date_saisie" class="form-label">Date de Saisie</label>
                <input type="date" class="form-control" name="date_saisie" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary fas fa-plus">Enregistrer</button>

    </form>
</div>

<script>
    const quantiteInput = document.getElementById('quantite');
    const prixInput = document.getElementById('prix');
    const totalInput = document.getElementById('total');

    function updateTotal() {
        const qte = parseFloat(quantiteInput.value) || 0;
        const prix = parseFloat(prixInput.value) || 0;
        totalInput.value = (qte * prix).toFixed(2);
    }

    quantiteInput.addEventListener('input', updateTotal);
    prixInput.addEventListener('input', updateTotal);
</script>
@endsection
