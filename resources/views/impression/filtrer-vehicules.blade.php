@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-filter me-2"></i>
                        Filtrer la consommation par véhicule
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('impression.vehicules.result') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="date_debut" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Date de début
                                </label>
                                <input type="date" 
                                       name="date_debut" 
                                       id="date_debut" 
                                       class="form-control" 
                                       value="{{ old('date_debut') }}"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <label for="date_fin" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Date de fin
                                </label>
                                <input type="date" 
                                       name="date_fin" 
                                       id="date_fin" 
                                       class="form-control" 
                                       value="{{ old('date_fin') }}"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <label for="vehicule_id" class="form-label">
                                    <i class="fas fa-car me-1"></i>
                                    Véhicule
                                </label>
                                <select name="vehicule_id" id="vehicule_id" class="form-select">
                                    <option value="all">Tous les véhicules</option>
                                    @foreach($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}" {{ old('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                            {{ $vehicule->n_vehicule }} - {{ $vehicule->marque }} {{ $vehicule->modele }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-search me-2"></i>
                                        Afficher la consommation
                                    </button>
                                    <a href="/bons" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Retour
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aide utilisateur -->
            <div class="mt-4">
                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle me-2"></i>Instructions :</h6>
                    <ul class="mb-0">
                        <li><strong>Période :</strong> Sélectionnez les dates de début et de fin pour définir la période d'analyse</li>
                        <li><strong>Véhicule :</strong> Choisissez un véhicule spécifique ou laissez "Tous les véhicules" pour une vue globale</li>
                        <li><strong>Résultats :</strong> Vous obtiendrez un récapitulatif de la consommation (essence/diesel) et des montants par véhicule</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
}

.form-label {
    font-weight: 600;
    color: #495057;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn {
    border-radius: 10px;
    font-weight: 600;
    padding: 12px 30px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    border: none;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
}

.alert-info {
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border-left: 4px solid #17a2b8;
}
</style>
@endsection
