<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Services\DocumentoService;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    protected DocumentoService $service;

    public function __construct(DocumentoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $documentos = $this->service->paginate();
        return view('admin.documentos.index', compact('documentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $this->service->create($validated);

        return redirect()->route('admin.documentos.index')->with('success', 'Documento creado correctamente.');
    }

    public function update(Request $request, Documento $documento)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $this->service->update($documento, $validated);

        return redirect()->route('admin.documentos.index')->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(Documento $documento)
    {
        $this->service->delete($documento);
        return redirect()->route('admin.documentos.index')->with('success', 'Documento eliminado correctamente.');
    }
}
