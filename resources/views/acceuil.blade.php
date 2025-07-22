@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    @media print {
  .no-print {
    display: none !important;
  }
}
</style>

<div class="container mt-4">
    <h2 class="mb-4 mt-4">Liste des Bons de Carburant</h2>
    
    <a href="{{ route('impression.acceuil.pdf') }}" class="btn btn-secondary text-center mb-3 my-2" target="_blank">
    🖨️ Imprimer la liste des bons
</a>


    <table class="table table-striped table-hover table-bordered ">
        <thead class="table-secondary">
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
                <th class="no-print">Action</th>
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
                    <td> 

                        <a href="{{ route('bons.edit', $bon->id) }}" class="btn btn-sm btn-warning no-print ">✏️ Modifier</a>

                        <form action="{{ route('bons.destroy', $bon->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce bon ?');">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger no-print ">🗑 Supprimer</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
