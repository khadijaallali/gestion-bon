<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bon; 
use App\Models\Site;
use App\Models\Service;
use App\Models\Vehicule;
use App\Models\Preneur; 


class BonController extends Controller
{

    
   public function __construct()
     {
        $this->middleware('auth');
     }
     
    public function index()
    {   $bons= new Bon ;
        $bons = Bon::all();
        return view('acceuil',compact('bons')); // Assurez-vous que la vue existe
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



}
