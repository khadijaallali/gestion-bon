<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bon; 
use App\Models\Site;
use App\Models\Service;
use App\Models\Vehicule;
use App\Models\Preneur; 
use App\Models\User;


class BonController extends Controller
{

    
   public function __construct()
     {
        $this->middleware('auth');
     }
     
    public function index()
    {
 $bons = \App\Models\Bon::latest()->get();
         return view('acceuil',compact('bons')); 
    }

    

public function create()
{
    return view('saisi.create', [
        'sites' => Site::all(),
        'services' => Service::all(),
        'vehicules' => Vehicule::all(),
        'preneurs' => Preneur::all()
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'n_bon' => 'required|string|max:255|unique:bons,n_bon',
        'type_carburant' => 'required|string',
        'site_id' => 'required|exists:sites,id',
        'service_id' => 'required|exists:services,id',
        'vehicule_id' => 'required|exists:vehicules,id',
        'preneur_id' => 'required|exists:preneurs,id',
        'quantite' => 'required|integer|min:1',
        'prix' => 'required|numeric|min:0',
        'date_bon' => 'required|date',
        'date_saisie' => 'required|date',
    ]);

    // Calcul du total
    $validated['total'] = $validated['quantite'] * $validated['prix'];
    $validated['utilisateur_id'] = auth()->id();

    Bon::create($validated);

    return redirect()->route('bons.index')->with('success', 'Bon ajouté avec succès.');
}

public function edit($id)
{
    $bon = Bon::findOrFail($id);

    return view('bons.edit', [
        'bon' => $bon,
        'sites' => Site::all(),
        'services' => Service::all(),
        'vehicules' => Vehicule::all(),
        'preneurs' => Preneur::all()
    ]);
}


public function update(Request $request, $id)
{
    $bon = Bon::findOrFail($id);

    $validated = $request->validate([
        'n_bon' => 'required|string|max:255|unique:bons,n_bon,' . $bon->id,
        'type_carburant' => 'required|string',
        'site_id' => 'required|exists:sites,id',
        'service_id' => 'required|exists:services,id',
        'vehicule_id' => 'required|exists:vehicules,id',
        'preneur_id' => 'required|exists:preneurs,id',
        'quantite' => 'required|integer|min:1',
        'prix' => 'required|numeric|min:0',
        'date_bon' => 'required|date',
        'date_saisie' => 'required|date',
    ]);

    // Calcul du total
    $validated['total'] = $validated['quantite'] * $validated['prix'];
    $validated['utilisateur_id'] = auth()->id();

    $bon->update($validated);

    return redirect()->route('bons.index')->with('success', 'Bon mis à jour avec succès.');
}   

public function destroy($id)
{
    $bon = Bon::findOrFail($id);
    $bon->delete();
    return redirect()->route('bons.index')->with('success', 'Bon supprimé avec succès.');
}

public function rechercherParMatricule()
{
    return view('recherche.matricule');
}

public function resultatParMatricule(Request $request)
{
    $matricule = $request->input('matricule');

  $bons = \App\Models\Bon::whereHas('preneur', function ($query) use ($matricule) {
        $query->where('n_matricule', 'like', "%$matricule%");
    })->get();

    return view('recherche.resultatM', compact('bons', 'matricule'));
}

public function rechercherParVehicule()
{
    return view('recherche.vehicule');
}

public function resultatParVehicule(Request $request)
{
    $vehicule = $request->input('vehicule');

  $bons = \App\Models\Bon::whereHas('vehicule', function ($query) use ($vehicule) {
        $query->where('n_vehicule', 'like', "%$vehicule%");
    })->get();
    
    return view('recherche.resultatV', compact('bons', 'vehicule'));
}

public function rechercherParNBon()
{
    return view('recherche.bon');
}

public function resultatParNBon(Request $request)
{
    $bon = $request->input('bon');

  $bons = \App\Models\Bon::whereHas('vehicule', function ($query) use ($bon) {
        $query->where('n_bon', 'like', "%$bon%");
    })->get();
    
    return view('recherche.resultatB', compact('bons', 'bon'));
}

public function printM($matricule)
{
    $bons = Bon::whereHas('preneur', function ($query) use ($matricule) {
        $query->where('n_matricule', 'like', '%' . $matricule . '%');
    })->get();

    return view('recherche.printM', compact('bons', 'matricule'));
}

public function printV($vehicule)
{
    $bons = Bon::whereHas('vehicule', function ($query) use ($vehicule) {
        $query->where('n_vehicule', 'like', '%' . $vehicule . '%');
    })->get();

    return view('recherche.printV', compact('bons', 'vehicule'));
}

public function printB($bon)
{
    $bons = Bon::where('n_bon', 'like', '%' . $bon . '%')->get();

    return view('recherche.printB', compact('bons', 'bon'));
}

 public function printT(Request $request)
{
    $bons = Bon::all();

    return view('recherche.printT', compact('bons'));
}

}


