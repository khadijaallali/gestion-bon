<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;


class ServiceController extends Controller
{
    public function create()
{
    return view('services.create');
}


public function store(Request $request)
{
    $validated = $request->validate([
        'code_service' => 'required|string|max:255|unique:services,code_service',
        'nom_service' => 'required|string|max:255',
    ]);

    Service::create($validated); 
    return redirect()->route('services.index')->with('success', 'Service ajouté avec succès.');
}


    public function index()
    {
        $services = \App\Models\Service::all();
        return view('services.index', compact('services'));
    }

    public function edit($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }
    public function update(Request $request, $id)
    {
        $service = \App\Models\Service::findOrFail($id);

        // Validate and update the service data
        $request->validate([
            'code_service' => 'required|string|max:255',
            'nom_service' => 'nullable|string',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

    


}
