<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected AreaService $service;

    public function __construct(AreaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $areas = $this->service->paginate();
        return view('admin.areas.index', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.areas.index')->with('success', 'Área creada correctamente.');
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $this->service->update($area, $validated);

        return redirect()->route('admin.areas.index')->with('success', 'Área actualizada correctamente.');
    }

    public function destroy(Area $area)
    {
        $this->service->delete($area);
        return redirect()->route('admin.areas.index')->with('success', 'Área eliminada correctamente.');
    }
}
