@extends('layouts.app')

@section('title', 'Editar Pregunta e Intención')

@section('content')
<div class="max-w-4xl mx-auto" x-data="{ 
    createNewTramite: false, 
    showHorarios: false, 
    showArea: false,
    showUbicacion: false,
    showCanales: false,
    showDocumentos: false,
    questions: {{ $intencion->preguntas->count() > 0 ? $intencion->preguntas->map(fn($q) => ['id' => $q->id, 'texto' => $q->pregunta, 'keywords' => is_array($q->keywords) ? implode(',', $q->keywords) : $q->keywords])->toJson() : '[{ id: null, texto: \'\', keywords: \'\' }]' }}
}">
    <div class="mb-8">
        <a href="{{ route('admin.preguntas.index') }}" class="text-slate-500 hover:text-indigo-600 flex items-center text-sm font-medium transition-colors mb-4">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al listado
        </a>
        <h3 class="text-3xl font-bold text-slate-800 tracking-tight">Editar Conocimiento</h3>
        <p class="text-slate-500 mt-2">Modifica la intención y sus variantes de pregunta.</p>
    </div>

    <form action="{{ route('admin.preguntas.update', $intencion) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Card 1: Trámite Relacionado -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 mb-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center me-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-slate-800">1. Trámite o Proceso</h4>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Trámite Actual</label>
                    <select name="tramite_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($tramites as $tramite)
                            <option value="{{ $tramite->id }}" {{ $intencion->tramite_id == $tramite->id ? 'selected' : '' }}>{{ $tramite->nombre_proceso }}</option>
                        @endforeach
                    </select>
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
                    <input type="text" name="titulo" value="{{ $intencion->titulo }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700">Respuesta Sugerida (Chatbot)</label>
                    <textarea name="respuesta_sugerida" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" required>{{ $intencion->respuesta_sugerida }}</textarea>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="activo" id="activo" class="w-5 h-5 text-indigo-600 border-slate-300 rounded" {{ $intencion->activo ? 'checked' : '' }}>
                    <label for="activo" class="ms-3 text-sm font-bold text-slate-700">Activo</label>
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
                <button type="button" @click="questions.push({ id: null, texto: '', keywords: '' })" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">+ Añadir Variante</button>
            </div>

            <div class="space-y-4">
                <template x-for="(q, index) in questions" :key="index">
                    <div class="relative p-6 bg-slate-50 border border-slate-200 rounded-2xl group">
                        <button type="button" @click="questions.splice(index, 1)" x-show="questions.length > 1" class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <input type="hidden" :name="`preguntas[${index}][id]`" x-model="q.id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Pregunta del Usuario</label>
                                <input type="text" :name="`preguntas[${index}][texto]`" x-model="q.texto" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-500 uppercase">Palabras Clave</label>
                                <input type="text" :name="`preguntas[${index}][keywords]`" x-model="q.keywords" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.preguntas.index') }}" class="px-6 py-3 text-sm font-bold text-slate-600 hover:bg-slate-200 rounded-2xl transition-colors">Cancelar</a>
            <button type="submit" class="px-10 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition-all transform hover:scale-105">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
