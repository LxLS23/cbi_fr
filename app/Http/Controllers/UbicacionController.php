<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Services\UbicacionService;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    protected UbicacionService $service;

    public function __construct(UbicacionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $ubicaciones = $this->service->paginate();
        return view('admin.ubicaciones.index', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ubicacion_fisica' => 'required|string|max:255',
            'referencia_piso_modulo' => 'nullable|string|max:255',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación creada correctamente.');
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
        $validated = $request->validate([
            'ubicacion_fisica' => 'required|string|max:255',
            'referencia_piso_modulo' => 'nullable|string|max:255',
        ]);

        $this->service->update($ubicacion, $validated);

        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $this->service->delete($ubicacion);
        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación eliminada correctamente.');
    }
}
