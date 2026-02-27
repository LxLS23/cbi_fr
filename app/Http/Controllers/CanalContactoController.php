<?php

namespace App\Http\Controllers;

use App\Models\CanalContacto;
use App\Services\CanalContactoService;
use Illuminate\Http\Request;

class CanalContactoController extends Controller
{
    protected CanalContactoService $service;

    public function __construct(CanalContactoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $canales = $this->service->paginate();
        return view('admin.canales.index', compact('canales'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:50',
            'valor' => 'required|string|max:255',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.canales.index')->with('success', 'Canal de contacto creado correctamente.');
    }

    public function update(Request $request, CanalContacto $canal)
    {
        $validated = $request->validate([
            'tipo' => 'required|string|max:50',
            'valor' => 'required|string|max:255',
        ]);

        $this->service->update($canal, $validated);

        return redirect()->route('admin.canales.index')->with('success', 'Canal de contacto actualizado correctamente.');
    }

    public function destroy(CanalContacto $canal)
    {
        $this->service->delete($canal);
        return redirect()->route('admin.canales.index')->with('success', 'Canal de contacto eliminado correctamente.');
    }
}
