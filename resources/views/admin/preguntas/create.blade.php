@extends('layouts.app')

@section('title', 'Nueva Pregunta e Intención')

@section('content')
<div class="max-w-4xl mx-auto" x-data="{ 
    createNewTramite: false, 
    showHorarios: false, 
    showArea: false,
    showUbicacion: false,
    questions: [{ texto: '', keywords: '' }]
}">
    <div class="mb-8">
        <a href="{{ route('admin.preguntas.index') }}" class="text-slate-500 hover:text-indigo-600 flex items-center text-sm font-medium transition-colors mb-4">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al listado
        </a>
        <h3 class="text-3xl font-bold text-slate-800 tracking-tight">Registro de Conocimiento</h3>
        <p class="text-slate-500 mt-2">Configura una intención (respuesta sugerida) y asóciala a un trámite con sus variantes de pregunta.</p>
    </div>

    <form action="{{ route('admin.preguntas.store') }}" method="POST">
        @csrf

        <!-- Card 1: Trámite Relacionado -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mb-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center me-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-slate-800">1. Trámite o Proceso</h4>
            </div>

            <div class="space-y-6">
                <div x-show="!createNewTramite">
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Seleccionar Trámite Existente</label>
                    <div class="flex gap-4">
                        <select name="tramite_id" class="flex-1 px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Selecciona un trámite...</option>
                            @foreach($tramites as $tramite)
                                <option value="{{ $tramite->id }}">{{ $tramite->nombre_proceso }}</option>
                            @endforeach
                        </select>
                        <button type="button" @click="createNewTramite = true" class="px-4 py-2 text-sm font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors">
                            + Crear Nuevo
                        </button>
                    </div>
                </div>

                <div x-show="createNewTramite" x-transition class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 space-y-4">
                    <div class="flex justify-between items-center">
                        <h5 class="text-sm font-bold text-indigo-800 uppercase tracking-wider">Nuevo Trámite</h5>
                        <button type="button" @click="createNewTramite = false" class="text-indigo-400 hover:text-indigo-600 text-xs font-bold">Cancelar</button>
                    </div>
                    <input type="hidden" name="create_new_tramite" :value="createNewTramite ? 1 : 0">
                    <div>
                        <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Nombre del Proceso</label>
                        <input type="text" name="new_tramite_nombre" placeholder="Ej. Inscripción a Licenciatura" class="w-full px-4 py-3 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ createNewArea: false, createNewUbicacion: false }">
                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Área Responsable</label>
                            <div x-show="!createNewArea">
                                <div class="flex gap-2">
                                    <select name="new_tramite_area_id" class="flex-1 px-4 py-3 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl">
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" @click="createNewArea = true" class="px-3 py-2 text-xs font-bold text-indigo-600 bg-white border border-indigo-100 rounded-lg shadow-sm">Nuevo</button>
                                </div>
                            </div>
                            <div x-show="createNewArea" class="space-y-2">
                                <input type="text" name="new_area_nombre" placeholder="Nombre de la nueva área" class="w-full px-4 py-2 bg-white border border-indigo-200 text-sm rounded-xl">
                                <button type="button" @click="createNewArea = false" class="text-[10px] text-slate-400 underline">Volver a selección</button>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Ubicación Física (Piso/Modulo)</label>
                            <div x-show="!createNewUbicacion">
                                <div class="flex gap-2">
                                    <select name="new_tramite_ubicacion_id" class="flex-1 px-4 py-3 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl">
                                        <option value="">Ninguna</option>
                                        @foreach($ubicaciones as $ubicacion)
                                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->ubicacion_fisica }} - {{ $ubicacion->referencia_piso_modulo }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" @click="createNewUbicacion = true" class="px-3 py-2 text-xs font-bold text-indigo-600 bg-white border border-indigo-100 rounded-lg shadow-sm">Nuevo</button>
                                </div>
                            </div>
                            <div x-show="createNewUbicacion" class="space-y-2">
                                <input type="text" name="new_ubicacion_fisica" placeholder="Ej. Edificio B, Planta Alta" class="w-full px-4 py-2 bg-white border border-indigo-200 text-sm rounded-xl">
                                <button type="button" @click="createNewUbicacion = false" class="text-[10px] text-slate-400 underline">Volver a selección</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Intención (Respuesta) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mb-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center me-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-slate-800">2. Intención y Respuesta</h4>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Título de la Intención</label>
                    <input type="text" name="titulo" placeholder="Ej. Requisitos de Inscripción" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" required>
                    <p class="text-slate-400 text-[11px] mt-1">Nombre interno para identificar esta respuesta.</p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Respuesta Sugerida (Chatbot)</label>
                    <textarea name="respuesta_sugerida" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe aquí la respuesta que el chatbot dará al usuario..." required></textarea>
                </div>
            </div>
        </div>

        <!-- Card 3: Preguntas (Variantes) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center me-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800">3. Variantes de Pregunta</h4>
                </div>
                <button type="button" @click="questions.push({ texto: '', keywords: '' })" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">+ Añadir Variante</button>
            </div>

            <div class="space-y-4">
                <template x-for="(q, index) in questions" :key="index">
                    <div class="relative p-6 bg-slate-50 border border-slate-200 rounded-2xl group">
                        <button type="button" @click="questions.splice(index, 1)" x-show="questions.length > 1" class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Pregunta del Usuario</label>
                                <input type="text" :name="`preguntas[${index}][texto]`" x-model="q.texto" placeholder="Ej. ¿Cómo me inscribo?" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Palabras Clave (Separadas por coma)</label>
                                <input type="text" :name="`preguntas[${index}][keywords]`" x-model="q.keywords" placeholder="inscripcion, requisitos, documentos" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Card 4: Datos Adicionales (Condicionales) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mb-8">
            <div class="flex items-center mb-8">
                <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center me-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-slate-800">4. Configuración Adicional</h4>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <label class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="show_horarios_check" x-model="showHorarios" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="ms-3 text-sm font-semibold text-slate-700">Horarios</span>
                </label>
                <label class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="show_canales_check" x-model="showCanales" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="ms-3 text-sm font-semibold text-slate-700">Canales de Contacto</span>
                </label>
                <label class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="show_documentos_check" x-model="showDocumentos" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="ms-3 text-sm font-semibold text-slate-700">Documentación</span>
                </label>
                <label class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="show_ubicacion_check" x-model="showUbicacion" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="ms-3 text-sm font-semibold text-slate-700">Localización</span>
                </label>
                <label class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="show_area_check" x-model="showArea" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span class="ms-3 text-sm font-semibold text-slate-700">Área Específica</span>
                </label>
            </div>

            <!-- Dynamic Sections -->
            <div class="space-y-6">
                <!-- Horarios Section -->
                <div x-show="showHorarios" x-transition class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <h5 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 me-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Registro de Horario para el Trámite
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Descripción</label>
                            <input type="text" name="horario_desc" placeholder="Ej. Atención Presencial" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Hora Inicio</label>
                            <input type="time" name="horario_inicio" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Hora Fin</label>
                            <input type="time" name="horario_fin" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Canales Section -->
                <div x-show="showCanales" x-transition class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <h5 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 me-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1.01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Vincular Canal de Contacto
                    </h5>
                    <select name="canal_id" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        <option value="">Selecciona un canal...</option>
                        @foreach($canales as $canal)
                            <option value="{{ $canal->id }}">{{ $canal->tipo }}: {{ $canal->valor }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Documentos Section -->
                <div x-show="showDocumentos" x-transition class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <h5 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 me-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Vincular Documentación Requerida
                    </h5>
                    <select name="documento_id" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        <option value="">Selecciona un documento...</option>
                        @foreach($documentos as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Área Section -->
                <div x-show="showArea" x-transition class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <h5 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 me-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Cambiar/Asignar Área al Trámite
                    </h5>
                    <select name="update_area_id" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        <option value="">Selecciona un área...</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Ubicacion Section -->
                <div x-show="showUbicacion" x-transition class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <h5 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 me-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Cambiar/Asignar Ubicación al Trámite
                    </h5>
                    <select name="update_ubicacion_id" class="w-full px-4 py-2 bg-white border border-slate-200 text-sm rounded-xl">
                        <option value="">Selecciona una ubicación...</option>
                        @foreach($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->ubicacion_fisica }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.preguntas.index') }}" class="px-6 py-3 text-sm font-bold text-slate-600 hover:bg-slate-200 rounded-2xl transition-colors">Cancelar</a>
            <button type="submit" class="px-10 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition-all transform hover:scale-105">
                Finalizar Registro
            </button>
        </div>
    </form>
</div>
@endsection
