<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Ubicacion;
use App\Models\Tramite;
use App\Models\Intencion;
use App\Models\PreguntaChat;
use App\Models\Horario;
use App\Models\CanalContacto;
use App\Models\Documento;
use App\Models\MedioDifusion;
use App\Services\TramiteService;
use App\Services\IntencionService;
use App\Services\PreguntaChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntaFrecuenteController extends Controller
{
    protected $tramiteService;
    protected $intencionService;
    protected $preguntaService;

    public function __construct(
        TramiteService $tramiteService,
        IntencionService $intencionService,
        PreguntaChatService $preguntaService
        )
    {
        $this->tramiteService = $tramiteService;
        $this->intencionService = $intencionService;
        $this->preguntaService = $preguntaService;
    }

    public function index()
    {
        $intentions = Intencion::with(['tramite', 'preguntas'])->paginate(10);
        return view('admin.preguntas.index', compact('intentions'));
    }

    public function create()
    {
        $areas = Area::all();
        $ubicaciones = Ubicacion::all();
        $tramites = Tramite::all();
        $canales = CanalContacto::all();
        $documentos = Documento::all();
        $medios = MedioDifusion::all();
        $horarios = Horario::all();

        return view('admin.preguntas.create', compact('areas', 'ubicaciones', 'tramites', 'canales', 'documentos', 'medios', 'horarios'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. Handle Tramite (Select existing or Create)
            $tramiteId = $request->tramite_id;
            if ($request->create_new_tramite) {
                $tramiteData = $request->validate([
                    'new_tramite_nombre' => 'required|string|max:255',
                    'new_tramite_area_id' => 'nullable|exists:AREAS,id',
                    'new_area_nombre' => 'nullable|string|max:150',
                    'new_tramite_ubicacion_id' => 'nullable|exists:UBICACIONES,id',
                    'new_ubicacion_fisica' => 'nullable|string|max:255',
                ]);

                // Create Area if dynamic
                $areaId = $tramiteData['new_tramite_area_id'];
                if ($request->filled('new_area_nombre')) {
                    $area = Area::create(['nombre' => $tramiteData['new_area_nombre']]);
                    $areaId = $area->id;
                }

                // Create Ubicacion if dynamic
                $ubicacionId = $tramiteData['new_tramite_ubicacion_id'];
                if ($request->filled('new_ubicacion_fisica')) {
                    $ubicacion = Ubicacion::create(['ubicacion_fisica' => $tramiteData['new_ubicacion_fisica']]);
                    $ubicacionId = $ubicacion->id;
                }

                // Validation: Ubicacion and Area are required for a new Tramite
                if (!$areaId || !$ubicacionId) {
                    throw new \Exception('El Área y la Ubicación son obligatorias para crear un nuevo trámite.');
                }

                $tramite = Tramite::create([
                    'nombre_proceso' => $tramiteData['new_tramite_nombre'],
                    'area_id' => $areaId,
                    'ubicacion_id' => $ubicacionId,
                ]);
                $tramiteId = $tramite->id;
            }

            // 2. Create Intencion (tramite_id is now optional)
            $intencionData = $request->validate([
                'titulo' => 'required|string|max:150',
                'respuesta_sugerida' => 'required|string',
                'activo' => 'boolean',
            ]);

            $intencion = Intencion::create([
                'tramite_id' => $tramiteId ?: null,
                'titulo' => $intencionData['titulo'],
                'respuesta_sugerida' => $intencionData['respuesta_sugerida'],
                'activo' => $request->has('activo'),
            ]);

            // 3. Create Questions
            $questions = $request->input('preguntas', []);
            foreach ($questions as $q) {
                if (!empty($q['texto'])) {
                    PreguntaChat::create([
                        'intencion_id' => $intencion->id,
                        'pregunta' => $q['texto'],
                        'keywords' => !empty($q['keywords']) ? explode(',', $q['keywords']) : [],
                        'activo' => true,
                    ]);
                }
            }

            // 4. Handle Conditional Base Data
            if ($tramiteId) {
                $tramite = Tramite::find($tramiteId);

                // Many-to-Many schedules
                if ($request->has('show_horarios_check')) {
                    // Sync existing schedules if any
                    if ($request->has('horario_ids')) {
                        $tramite->horarios()->syncWithoutDetaching($request->horario_ids);
                    }

                    // Create and attach new schedule if provided
                    if ($request->filled('horario_desc')) {
                        $horario = Horario::create([
                            'descripcion' => $request->horario_desc,
                            'hora_inicio' => $request->horario_inicio,
                            'hora_fin' => $request->horario_fin,
                        ]);
                        $tramite->horarios()->attach($horario->id);
                    }
                }

                if ($request->has('show_canales_check') && $request->filled('canal_id')) {
                    $tramite->canales()->syncWithoutDetaching($request->canal_id);
                }

                if ($request->has('show_documentos_check') && $request->filled('documento_id')) {
                    $tramite->documentos()->syncWithoutDetaching($request->documento_id);
                }

                // Sync Area/Ubicacion if explicitly checked in Section 4 for an existing tramite
                if (!$request->create_new_tramite) {
                    if ($request->has('show_area_check') && $request->filled('update_area_id')) {
                        $tramite->update(['area_id' => $request->update_area_id]);
                    }
                    if ($request->has('show_ubicacion_check') && $request->filled('update_ubicacion_id')) {
                        $tramite->update(['ubicacion_id' => $request->update_ubicacion_id]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.preguntas.index')->with('success', 'Pregunta e Intención registradas correctamente.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in PreguntaFrecuenteController@store: ' . $e->getMessage());
            return back()->with('error', 'Error al registrar: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Intencion $pregunta)
    {
        // $pregunta is actually an Intencion model because of resource routing binding
        $intencion = $pregunta->load(['tramite.horarios', 'preguntas']);
        $areas = Area::all();
        $ubicaciones = Ubicacion::all();
        $tramites = Tramite::all();
        $canales = CanalContacto::all();
        $documentos = Documento::all();
        $medios = MedioDifusion::all();
        $horarios = Horario::all();

        return view('admin.preguntas.edit', compact('intencion', 'areas', 'ubicaciones', 'tramites', 'canales', 'documentos', 'medios', 'horarios'));
    }

    public function update(Request $request, Intencion $pregunta)
    {
        $intencion = $pregunta;

        DB::beginTransaction();
        try {
            // 1. Update Intencion
            $intencionData = $request->validate([
                'titulo' => 'required|string|max:150',
                'respuesta_sugerida' => 'required|string',
                'tramite_id' => 'nullable|exists:TRAMITES,id',
            ]);

            $intencion->update([
                'titulo' => $intencionData['titulo'],
                'respuesta_sugerida' => $intencionData['respuesta_sugerida'],
                'tramite_id' => $intencionData['tramite_id'],
                'activo' => $request->has('activo'),
            ]);

            // Handle schedule synchronization if a tramite is linked
            if ($intencion->tramite_id && $request->has('horario_ids')) {
                $intencion->tramite->horarios()->sync($request->horario_ids);
            }

            // 2. Update Questions (Simple logic: delete old ones and create new ones or sync)
            $intencion->preguntas()->delete();
            $questions = $request->input('preguntas', []);
            foreach ($questions as $q) {
                if (!empty($q['texto'])) {
                    PreguntaChat::create([
                        'intencion_id' => $intencion->id,
                        'pregunta' => $q['texto'],
                        'keywords' => !empty($q['keywords']) ? explode(',', $q['keywords']) : [],
                        'activo' => true,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.preguntas.index')->with('success', 'Pregunta e Intención actualizadas correctamente.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Intencion $intencion)
    {
        $intencion->delete();
        return redirect()->route('admin.preguntas.index')->with('success', 'Intención eliminada correctamente.');
    }
}
