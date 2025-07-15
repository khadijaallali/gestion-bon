<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

public function resultatParSite(Request $request)
{
    $query = Bon::query()->with('site');

    if ($request->filled('date_debut')) {
        $query->whereDate('date_bon', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('date_bon', '<=', $request->date_fin);
    }

    $bons = $query->get();

    $recap = [];
    foreach ($bons as $bon) {
        $siteId = $bon->site_id;
        $siteName = $bon->site->nom_site ?? '';
        $siteCode = $bon->site->code_site ?? '';
        $type = strtolower($bon->type_carburant);

        if (!isset($recap[$siteId])) {
            $recap[$siteId] = [
                'code_site' => $siteCode,
                'nom_site' => $siteName,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
        }
        if ($type === 'essence') {
            $recap[$siteId]['essence_l'] += $bon->quantite;
            $recap[$siteId]['montant_essence'] += $bon->total;
        } elseif ($type === 'diesel') {
            $recap[$siteId]['diesel_l'] += $bon->quantite;
            $recap[$siteId]['montant_diesel'] += $bon->total;
        }
    }

    // Calcul du montant total par site
    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }

    return view('impression.resultats-site', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}
public function filtrerParSite()
{
    return view('impression.filtrer-site');
}

public function resultatParService(Request $request)
{
    $query = Bon::query()->with('service');

    if ($request->filled('date_debut')) {
        $query->whereDate('date_bon', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('date_bon', '<=', $request->date_fin);
    }

    $bons = $query->get();

    $recap = [];
    foreach ($bons as $bon) {
        $serviceId = $bon->service_id;
        $serviceName = $bon->service->nom_service ?? '';
        $serviceCode = $bon->service->code_service ?? '';
        $type = strtolower(trim($bon->type_carburant));

        if (!isset($recap[$serviceId])) {
            $recap[$serviceId] = [
                'code_service' => $serviceCode,
                'nom_service' => $serviceName,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
        }

        if ($type === 'essence') {
            $recap[$serviceId]['essence_l'] += $bon->quantite;
            $recap[$serviceId]['montant_essence'] += $bon->total;
        } elseif ($type === 'diesel') {
            $recap[$serviceId]['diesel_l'] += $bon->quantite;
            $recap[$serviceId]['montant_diesel'] += $bon->total;
        }
    }

    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }

    return view('impression.resultats-service', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}

public function filtrerParService()
{
    return view('impression.filtrer-service');
}

public function filtrerParPeriode()
{
    return view('bons.filtrer-periode');
}

public function saisirParPeriode(Request $request)
{
    $date_debut = $request->date_debut;
    $date_fin = $request->date_fin;

    $bons = Bon::whereBetween('date_bon', [$date_debut, $date_fin])
               ->with(['site', 'service', 'vehicule', 'preneur']) 
               ->get();

    return view('impression.saisie-periode', [
        'bons' => $bons,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin
    ]);
}

public function filtrerParbon()
{
    return view('impression.filtrer-bon');
}

public function updateMultiple(Request $request)
{
    foreach ($request->bons as $bonData) {
        $bon = Bon::find($bonData['id']);
        if ($bon) {
            $bon->type_carburant = $bonData['type_carburant'];
            $bon->quantite = $bonData['quantite'];
            $bon->prix = $bonData['prix'];
            $bon->total = $bon->quantite * $bon->prix;
            $bon->save();
        }
    }

    return redirect()->back()->with('success', 'Bons mis à jour avec succès.');
}


public function resultatParPreneur(Request $request)
{
    $query = Bon::query()->with('preneur');

    if ($request->filled('date_debut')) {
        $query->whereDate('date_bon', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('date_bon', '<=', $request->date_fin);
    }

    $bons = $query->get();

    $recap = [];
    foreach ($bons as $bon) {
        $preneurId = $bon->preneur_id;
        $preneurName = $bon->preneur->nom ?? 'Inconnu';
        $type = strtolower(trim($bon->type_carburant));

        if (!isset($recap[$preneurId])) {
            $recap[$preneurId] = [
                'nom_preneur' => $preneurName,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
        }
        if ($type === 'essence') {
            $recap[$preneurId]['essence_l'] += $bon->quantite;
            $recap[$preneurId]['montant_essence'] += $bon->total;
        } elseif ($type === 'diesel') {
            $recap[$preneurId]['diesel_l'] += $bon->quantite;
            $recap[$preneurId]['montant_diesel'] += $bon->total;
        }
    }

    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }

    return view('impression.resultats-preneurs', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}

public function filtrerParpreneur()
{
    return view('impression.filtrer-preneur');
}

public function TablePrintVehicule(Request $request)
{
    $query = Bon::query()->with(['vehicule','preneur']);

    if ($request->filled('date_debut')) {
        $query->whereDate('date_bon', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('date_bon', '<=', $request->date_fin);
    }

    $bons = $query->get();

    $recap = [];
    foreach ($bons as $bon) {
         if (!$bon->vehicule || !$bon->preneur) continue ;
        $vehicule = $bon->vehicule;
        $preneur = $bon->preneur;

        $cle = $vehicule->id . '_' . $preneur->id;
        $type = strtolower(trim($bon->type_carburant));

        if (!isset($recap[$cle])) {
            $recap[$cle] = [
                'numero' => $vehicule->n_vehicule ?? '',
                'marque' => $vehicule->marque ?? '',
                'modele' => $vehicule->modele ?? '',
                'preneur' => $preneur->nom ?? 'Inconnu',
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
        }
        if ($type === 'essence') {
            $recap[$cle]['essence_l'] += $bon->quantite;
            $recap[$cle]['montant_essence'] += $bon->total;
        } 
        elseif ($type === 'diesel') {
            $recap[$cle]['diesel_l'] += $bon->quantite;
            $recap[$cle]['montant_diesel'] += $bon->total;
        }
    }

    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }
    
    return view('impression.resultats-vehicules', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}

public function filtrerParVehicule()
{
    return view('impression.filtrer-vehicules');
}

}


