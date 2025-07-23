@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        padding: 20px 0;
    }

    .main-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        margin: 20px auto;
        max-width: 95%;
        animation: slideIn 0.6s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(102, 126, 234, 0.2);
    }

    .page-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .brand-logo {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .print-btn {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        margin-bottom: 1.5rem;
    }

    .print-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        color: white;
    }

    .modern-table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .modern-table thead th {
        border: none;
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .modern-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modern-table tbody td {
        padding: 1rem 0.75rem;
        border: none;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        margin: 2px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #8b4513;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(252, 182, 159, 0.4);
        color: #8b4513;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #dc3545;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 154, 158, 0.4);
        color: #dc3545;
    }

    .table-responsive {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 10px;
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .modern-table {
            font-size: 0.8rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.5rem 0.3rem;
        }
    }

    @media print {
        .no-print {
            display: none !important;
        }
        
        body {
            background: white;
        }
        
        .main-container {
            background: white;
            box-shadow: none;
            border: none;
        }
    }
</style>

<div class="main-container">
    <div class="page-header">
        <h1 class="page-title">Liste des Bons de Carburant</h1>
    </div>
    
    <a href="{{ route('impression.acceuil.pdf') }}" class="print-btn no-print" target="_blank">
        <i class="fas fa-print"></i> Imprimer la liste des bons
    </a>

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
                <th>Véhicule</th>
                <th>Preneur</th>
                <th>Date Bon</th>
                <th>Date Saisie</th>
                @if(auth()->user()->role === 'admin')
                <th class="no-print"><i class="fas fa-cogs"></i> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($bons as $bon)
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
                    @if(auth()->user()->role === 'admin')
                    <td class="no-print"> 
                        <a href="{{ route('bons.edit', $bon->id) }}" class="action-btn btn-edit">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                        <form action="{{ route('bons.destroy', $bon->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce bon ?');">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection
