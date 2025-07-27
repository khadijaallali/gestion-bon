@extends('layouts.app')

@section('title', 'Résultats de recherche par matricule')

@section('content')
@include('components.modern-page-style')

<div class="modern-page-container">
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">
                <i class="fas fa-search-plus"></i>
            </div>
            <div class="header-text">
                <h1 class="page-title">Résultats de Recherche</h1>
                <p class="page-subtitle">Recherche par matricule : <strong class="search-term">{{ $matricule }}</strong></p>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('recherche.matricule') }}" class="search-btn">
                <i class="fas fa-search"></i> Nouvelle recherche
            </a>
            <a href="{{ route('bons.printM', ['matricule' => $matricule]) }}" class="print-btn no-print" target="_blank">
                <i class="fas fa-print"></i> Imprimer
            </a>
        </div>
    </div>

    <div class="content-section">
        @if ($bons->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search-minus"></i>
                </div>
                <h3 class="empty-title">Aucun résultat trouvé</h3>
                <p class="empty-description">Aucun bon de carburant n'a été trouvé pour le matricule <strong>{{ $matricule }}</strong>.</p>
                <a href="{{ route('recherche.matricule') }}" class="search-btn">
                    <i class="fas fa-search"></i> Effectuer une nouvelle recherche
                </a>
            </div>
        @else
            <div class="results-summary">
                <div class="summary-item">
                    <i class="fas fa-list"></i>
                    <span><strong class="summary-number">{{ $bons->count() }}</strong> bon(s) trouvé(s)</span>
                </div>
                <div class="summary-item">
                    <i class="fas fa-calculator"></i>
                    <span>Total : <strong class="summary-total">{{ number_format($bons->sum('total'), 2) }} DH</strong></span>
                </div>
                 <div class="summary-item">
                    <i class="fas fa-gas-pump"></i>
                    <span>Quantité : <strong class="summary-quantity">{{ $bons->sum('quantite') }} L</strong></span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table modern-table">
                    <thead>
                        <tr>
                            <th>N° Bon</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total</th>
                            <th>Type Carburant</th>
                            <th>Site</th>
                            <th>Service</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>N° Véhicule</th>
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
                                <td>{{ $bon->vehicule->marque ?? '' }}</td>
                                <td>{{ $bon->vehicule->modele ?? '' }}</td>
                                <td>{{ $bon->vehicule->n_vehicule ?? '' }}</td>
                                <td>{{ $bon->preneur->nom ?? '' }}</td>
                                <td>{{ $bon->date_bon }}</td>
                                <td>{{ $bon->date_saisie }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
.search-term {
    color: #4facfe;
    text-shadow: 0 0 10px rgba(79, 172, 254, 0.3);
}

.results-summary {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.summary-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #2c3e50;
    font-size: 1rem;
    font-weight: 500;
}

.summary-item i {
    color: #4facfe;
}

.summary-number, .summary-total {
    color: #4facfe;
    text-shadow: 0 0 5px rgba(79, 172, 254, 0.3);
    font-weight: 600;
}

.search-btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.95rem;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    margin-right: 1rem;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.print-btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.95rem;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
}

.print-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
    color: white;
    text-decoration: none;
}

@media (max-width: 768px) {
    .results-summary {
        flex-direction: column;
        gap: 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .search-btn {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
