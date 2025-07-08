<?php

namespace App\Http\Controllers;
use App\Models\Preneur; 
use Illuminate\Http\Request;

class PreneurController extends Controller
{   

public function index()
{
    $preneurs = Preneur::all(); 
    return view('preneurs.index', compact('preneurs')); 
}
  

    public function create()
    {
        return view('preneurs.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'n_matricule' => 'required|string|max:255|unique:preneurs',
            'nom' => 'required|string|max:255',
        ]);

        Preneur::create($data);
        return redirect()->route('preneurs.index')->with('success', 'Preneur created successfully.');
    
}

    public function edit($id)
{
    $preneur = Preneur::findOrFail($id);
    return view('preneurs.edit', compact('preneur'));
}


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'n_matricule' => 'required|string|max:255|unique:preneurs,n_matricule,' . $id,
            'nom' => 'required|string|max:255',
        ]);
        $preneur = Preneur::findOrFail($id);
        $preneur->update($data);
        return redirect()->route('preneurs.index')->with('success', 'Preneur updated successfully.');
    }

    public function destroy($id)
    {
        $preneur = Preneur::findOrFail($id);
        $preneur->delete();
        return redirect()->route('preneurs.index')->with('success', 'Preneur deleted successfully.');
    }


}