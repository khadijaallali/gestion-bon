<?php

namespace App\Http\Controllers;
use App\Models\Site;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function create()
{
    return view('sites.create'); // formulaire d'ajout
}

public function store(Request $request)
{
    $validated = $request->validate([
        'code_site' => 'required|string|unique:sites,code_site',
        'nom_site' => 'required|string',
    ]);

    Site::create($validated);

    return redirect()->route('sites.index')->with('success', 'Site ajouté avec succès.');
}

public function index()
{
    $sites = Site::all(); // Collection d'objets
    return view('sites.index', compact('sites'));
}

public function destroy($id)
{
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect()->route('sites.index')->with('success', 'Le site a été supprimé avec succès.');
}
public function edit($id)
{
    $site = Site::findOrFail($id);
    return view('sites.edit', compact('site')); // formulaire de modification

}
public function update(Request $request, $id)
{
    $request->validate([
        'code_site' => 'required|string|max:255',
        'nom_site' => 'required|string|max:255',
    ]);

    $site = Site::findOrFail($id);
    $site->code_site = $request->code_site;
    $site->nom_site = $request->nom_site;
    $site->save();

    return redirect()->route('sites.index')->with('success', 'Site modifié avec succès.');
}


}
