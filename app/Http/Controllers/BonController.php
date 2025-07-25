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
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;




class BonController extends Controller
{

   public function __construct()
     {
        $this->middleware('auth');
     }
     
    public function index()
    {
        $bons = \App\Models\Bon::latest()->with(['vehicule', 'preneur'])->get();
        return view('acceuil', compact('bons'));
    }

    public function exportAcceuilPDF(Request $request)
    {
        $bons = Bon::latest()->with(['vehicule', 'preneur'])->get();
        $pdf = PDF::loadView('impression.pdf-acceuil', [
            'bons' => $bons,
            'print_mode' => true,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('liste_bons.pdf');
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
    ]);

    // Calcul du total
    $validated['date_saisie'] = now();
    $validated['total'] = $validated['quantite'] * $validated['prix'];
    $validated['utilisateur_id'] = auth()->id();
    $bon = Bon::create($validated);

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
    ]);

    // Calcul du total
    $validated['date_saisie'] = now();
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

    // Nouveau filtre par site spécifique
    if ($request->filled('site_id') && $request->site_id != 'all') {
        $query->where('site_id', $request->site_id);
    }

    $bons = $query->get();

    $recap = [];

    // Si un site spécifique est sélectionné, calculer seulement pour ce site
    if ($request->filled('site_id') && $request->site_id != 'all') {
        $siteSelectionne = \App\Models\Site::find($request->site_id);
        if ($siteSelectionne && $bons->isNotEmpty()) {
            $siteId = $siteSelectionne->id;
            $recap[$siteId] = [
                'code_site' => $siteSelectionne->code_site,
                'nom_site' => $siteSelectionne->nom_site,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
            foreach ($bons as $bon) {
                $type = strtolower(trim($bon->type_carburant));
                if ($type === 'essence') {
                    $recap[$siteId]['essence_l'] += $bon->quantite;
                    $recap[$siteId]['montant_essence'] += $bon->total;
                } elseif ($type === 'diesel') {
                    $recap[$siteId]['diesel_l'] += $bon->quantite;
                    $recap[$siteId]['montant_diesel'] += $bon->total;
                }
            }
            $recap[$siteId]['montant_total'] = $recap[$siteId]['montant_essence'] + $recap[$siteId]['montant_diesel'];
        }
    } else {
        // Si "Tous les sites" est sélectionné, afficher tous les sites
        foreach ($bons as $bon) {
            $siteId = $bon->site_id;
            $siteName = $bon->site->nom_site ?? '';
            $siteCode = $bon->site->code_site ?? '';
            $type = strtolower(trim($bon->type_carburant));
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
        foreach ($recap as &$row) {
            $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
        }
    }

    return view('impression.resultats-site', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}

public function exportSitePDF(Request $request)
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
                'site' => $siteName,
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
    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }
    $pdf = PDF::loadView('impression.pdf-site', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'print_mode' => true,
    ])->setPaper('A4', 'landscape');
    return $pdf->download('rapport_sites.pdf');
}
public function filtrerParSite()
{
    $sites = \App\Models\Site::orderBy('nom_site')->get();
    return view('impression.filtrer-site', compact('sites'));
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
    
    // Nouveau filtre par service spécifique
    if ($request->filled('service_id') && $request->service_id != 'all') {
        $query->where('service_id', $request->service_id);
    }

    $bons = $query->get();

    $recap = [];
    
    // Si un service spécifique est sélectionné, calculer seulement pour ce service
    if ($request->filled('service_id') && $request->service_id != 'all') {
        $serviceSelectionne = Service::find($request->service_id);
        
        if ($serviceSelectionne && $bons->isNotEmpty()) {
            $serviceId = $serviceSelectionne->id;
            $recap[$serviceId] = [
                'code_service' => $serviceSelectionne->code_service,
                'nom_service' => $serviceSelectionne->nom_service,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];

            foreach ($bons as $bon) {
                $type = strtolower(trim($bon->type_carburant));
                
                if ($type === 'essence') {
                    $recap[$serviceId]['essence_l'] += $bon->quantite;
                    $recap[$serviceId]['montant_essence'] += $bon->total;
                } elseif ($type === 'diesel') {
                    $recap[$serviceId]['diesel_l'] += $bon->quantite;
                    $recap[$serviceId]['montant_diesel'] += $bon->total;
                }
            }
            
            $recap[$serviceId]['montant_total'] = $recap[$serviceId]['montant_essence'] + $recap[$serviceId]['montant_diesel'];
        }
        
        $serviceSelectionne = $serviceSelectionne;
    } else {
        // Si "Tous les services" est sélectionné, afficher tous les services
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
        
        $serviceSelectionne = null;
    }

    return view('impression.resultats-service', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'service_selectionne' => $serviceSelectionne,
    ]);
}

public function exportServicePDF(Request $request)
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
        $type = strtolower(trim($bon->type_carburant));
        if (!isset($recap[$serviceId])) {
            $recap[$serviceId] = [
                'service' => $serviceName,
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
    $pdf = PDF::loadView('impression.pdf-service', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'print_mode' => true,
    ])->setPaper('A4', 'landscape');
    return $pdf->download('rapport_services.pdf');
}


public function filtrerParService()
{
    $services = Service::orderBy('nom_service')->get();
    return view('impression.filtrer-service', compact('services'));
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

public function exportSaisiePeriodePDF(Request $request)
{
    $date_debut = $request->date_debut;
    $date_fin = $request->date_fin;
    $bons = Bon::whereBetween('date_bon', [$date_debut, $date_fin])
        ->with(['site', 'service', 'vehicule', 'preneur'])
        ->get();
    $pdf = PDF::loadView('impression.pdf-saisie-periode', [
        'bons' => $bons,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'print_mode' => true,
    ])->setPaper('A4', 'landscape');
    return $pdf->download('saisie_periode.pdf');
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

    // Nouveau filtre par preneur spécifique
    if ($request->filled('preneur_id') && $request->preneur_id != 'all') {
        $query->where('preneur_id', $request->preneur_id);
    }

    $bons = $query->get();

    $recap = [];

    // Si un preneur spécifique est sélectionné, calculer seulement pour cet agent
    if ($request->filled('preneur_id') && $request->preneur_id != 'all') {
        $preneurSelectionne = \App\Models\Preneur::find($request->preneur_id);
        if ($preneurSelectionne && $bons->isNotEmpty()) {
            $preneurId = $preneurSelectionne->id;
            $recap[$preneurId] = [
                'nom_preneur' => $preneurSelectionne->nom,
                'essence_l' => 0,
                'diesel_l' => 0,
                'montant_essence' => 0,
                'montant_diesel' => 0,
            ];
            foreach ($bons as $bon) {
                $type = strtolower(trim($bon->type_carburant));
                if ($type === 'essence') {
                    $recap[$preneurId]['essence_l'] += $bon->quantite;
                    $recap[$preneurId]['montant_essence'] += $bon->total;
                } elseif ($type === 'diesel') {
                    $recap[$preneurId]['diesel_l'] += $bon->quantite;
                    $recap[$preneurId]['montant_diesel'] += $bon->total;
                }
            }
            $recap[$preneurId]['montant_total'] = $recap[$preneurId]['montant_essence'] + $recap[$preneurId]['montant_diesel'];
        }
    } else {
        // Si "Tous les agents" est sélectionné, afficher tous les agents
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
    }

    return view('impression.resultats-preneurs', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);
}

public function exportPreneursPDF(Request $request)
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
        $preneurName = $bon->preneur->nom?? '';
        $type = strtolower(trim($bon->type_carburant));
        if (!isset($recap[$preneurId])) {
            $recap[$preneurId] = [
                'preneur' => $preneurName,
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
    $pdf = PDF::loadView('impression.pdf-preneurs', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'print_mode' => true,
    ])->setPaper('A4', 'landscape');
    return $pdf->download('rapport_preneurs.pdf');
}


public function filtrerParpreneur()
{
    $preneurs = \App\Models\Preneur::orderBy('nom')->get();
    return view('impression.filtrer-preneur', compact('preneurs'));
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

    // Nouveau filtre par véhicule spécifique
    if ($request->filled('vehicule_id') && $request->vehicule_id != 'all') {
        $query->where('vehicule_id', $request->vehicule_id);
    }

    $bons = $query->get();

    $recap = [];

    // Si un véhicule spécifique est sélectionné, calculer seulement pour ce véhicule
    if ($request->filled('vehicule_id') && $request->vehicule_id != 'all') {
        $vehiculeSelectionne = \App\Models\Vehicule::find($request->vehicule_id);
        if ($vehiculeSelectionne && $bons->isNotEmpty()) {
            foreach ($bons as $bon) {
                if (!$bon->vehicule || !$bon->preneur) continue;
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
                } elseif ($type === 'diesel') {
                    $recap[$cle]['diesel_l'] += $bon->quantite;
                    $recap[$cle]['montant_diesel'] += $bon->total;
                }
            }
            foreach ($recap as &$row) {
                $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
            }
        }
    } else {
        // Si "Tous les véhicules" est sélectionné, afficher tous les véhicules
        foreach ($bons as $bon) {
            if (!$bon->vehicule || !$bon->preneur) continue;
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
            } elseif ($type === 'diesel') {
                $recap[$cle]['diesel_l'] += $bon->quantite;
                $recap[$cle]['montant_diesel'] += $bon->total;
            }
        }
        foreach ($recap as &$row) {
            $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
        }
    }
    
    return view('impression.resultats-vehicules', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'print_mode' => false, 
    ]);
}


public function exportVehiculePDF(Request $request)
{
    $query = Bon::query()->with(['vehicule', 'preneur']);

    if ($request->filled('date_debut')) {
        $query->whereDate('date_bon', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('date_bon', '<=', $request->date_fin);
    }

    $bons = $query->get();

    $recap = [];
    foreach ($bons as $bon) {
        if (!$bon->vehicule || !$bon->preneur) continue;

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
        } elseif ($type === 'diesel') {
            $recap[$cle]['diesel_l'] += $bon->quantite;
            $recap[$cle]['montant_diesel'] += $bon->total;
        }
    }

    foreach ($recap as &$row) {
        $row['montant_total'] = $row['montant_essence'] + $row['montant_diesel'];
    }

   $pdf = PDF::loadView('impression.pdf-vehicules', [
        'recap' => $recap,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'print_mode' => true, 
    ])->setPaper('A4', 'landscape');

    return $pdf->download('rapport_vehicules.pdf');
}


public function filtrerParVehicule()
{
    $vehicules = \App\Models\Vehicule::orderBy('n_vehicule')->get();
    return view('impression.filtrer-vehicules', compact('vehicules'));
}

public function exportCSV()
{
    $bons = Bon::all();

    $csvHeader = ['ID', 'Type', 'Quantité', 'Montant', 'Date'];
    $filename = 'bons_export.csv';

    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, $csvHeader);

    foreach ($bons as $bon) {
        fputcsv($handle, [
            $bon->id,
            $bon->n_bon,
            $bon->prix,
            $bon->total,
            $bon->type_carburant,
            $bon->quantite,
            $bon->site->nom_site,
            $bon->service->nom_service,
            $bon->vehicule->n_vehicule,
            $bon->preneur->nom,
            $bon->created_at,
        ]);
    }

    rewind($handle);
    $csvContent = stream_get_contents($handle);
    fclose($handle);

    return Response::make($csvContent, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);

}
}
