<?php

namespace App\Http\Controllers;
use App\Models\Vehicule;

use Illuminate\Http\Request;

class VehiculeController extends Controller
{

    
     public function create()
{
    return view('vehicules.create'); 
}

public function store(Request $request)
{
    $validated = $request->validate([
        'n_vehicule' => 'required|string|unique:sites,code_site',
        'marque' => 'required|string',
        'modele' => 'required|string',

    ]);

    Vehicule::create($validated);

    return redirect()->route('vehicules.index')->with('success', 'Véhicule ajoutée avec succès.');
}

public function index()
{
    $vehicules = Vehicule::all();
    return view('vehicules.index', compact('vehicules'));
}

public function destroy($id)
{
    $vehicule = Vehicule::findOrFail($id);
    $vehicule->delete();

    return redirect()->route('vehicules.index')->with('success', 'La véhicule a été supprimé avec succès.');
}
public function edit($id)
{
    $vehicule = Vehicule::findOrFail($id);
    return view('vehicules.edit', compact('vehicule')); // formulaire de modification

}
public function update(Request $request, $id)
{
    $request->validate([
        'n_vehicule' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'modele' => 'required|string|max:255',
    ]);


    $vehicule = Vehicule::findOrFail($id);
    $vehicule->n_vehicule = $request->n_vehicule;
    $vehicule->marque = $request->marque;
    $vehicule->modele = $request->modele;
    $vehicule->save();

    return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié avec succès.');
}


}

