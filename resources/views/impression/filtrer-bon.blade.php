@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-filter me-2"></i>
                        Filtrer la consommation par bon
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('impression.bon.result') }}" method="POST">
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

                          <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-search me-2"></i>
                                        Afficher les résultats
                                    </button>
                                    <a href="/bons" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Retour
                                    </a>
                                </div>
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
                        <li><strong>Résultats :</strong> Vous obtiendrez un récapitulatif de la consommation par bon sur la période choisie</li>
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

.alert-info {
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border-left: 4px solid #17a2b8;
}
</style>
@endsection
