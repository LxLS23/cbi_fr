<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Tramite;
use App\Services\HorarioService;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    protected HorarioService $service;

    public function __construct(HorarioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $horarios = $this->service->paginate();
        $tramites = Tramite::all();
        return view('admin.horarios.index', compact('horarios', 'tramites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tramite_id' => 'nullable|exists:TRAMITES,id',
            'descripcion' => 'required|string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.horarios.index')->with('success', 'Horario creado correctamente.');
    }

    public function update(Request $request, Horario $horario)
    {
        $validated = $request->validate([
            'tramite_id' => 'nullable|exists:TRAMITES,id',
            'descripcion' => 'required|string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $this->service->update($horario, $validated);

        return redirect()->route('admin.horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $this->service->delete($horario);
        return redirect()->route('admin.horarios.index')->with('success', 'Horario eliminado correctamente.');
    }
}
