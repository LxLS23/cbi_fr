<?php

namespace App\Http\Controllers;

use App\Models\MedioDifusion;
use App\Services\MedioDifusionService;
use Illuminate\Http\Request;

class MedioDifusionController extends Controller
{
    protected MedioDifusionService $service;

    public function __construct(MedioDifusionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $medios = $this->service->paginate();
        return view('admin.medios.index', compact('medios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medio' => 'required|string|max:100',
            'url' => 'nullable|url|max:255',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.medios.index')->with('success', 'Medio de difusión creado correctamente.');
    }

    public function update(Request $request, MedioDifusion $medio)
    {
        $validated = $request->validate([
            'medio' => 'required|string|max:100',
            'url' => 'nullable|url|max:255',
        ]);

        $this->service->update($medio, $validated);

        return redirect()->route('admin.medios.index')->with('success', 'Medio de difusión actualizado correctamente.');
    }

    public function destroy(MedioDifusion $medio)
    {
        $this->service->delete($medio);
        return redirect()->route('admin.medios.index')->with('success', 'Medio de difusión eliminado correctamente.');
    }
}
