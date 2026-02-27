@extends('layouts.app')

@section('title', 'Gestión de Preguntas e Intenciones')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h3 class="text-2xl font-bold text-slate-800">Preguntas e Intenciones</h3>
        <p class="text-slate-500 text-sm">Administra las respuestas del chatbot y sus variantes de pregunta.</p>
    </div>
    <a href="{{ route('admin.preguntas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all duration-200">
        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nueva Pregunta
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm shadow-slate-100 overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold text-[11px] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Trámite</th>
                <th class="px-6 py-4">Intención / Respuesta</th>
                <th class="px-6 py-4">Variantes de Pregunta</th>
                <th class="px-6 py-4">Estado</th>
                <th class="px-6 py-4 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($intentions as $intent)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    @if($intent->tramite)
                        <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">{{ $intent->tramite->nombre_proceso }}</span>
                    @else
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded-lg">CONOCIMIENTO GENERAL</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="max-w-xs">
                        <span class="block font-bold text-slate-700">{{ $intent->titulo }}</span>
                        <p class="text-slate-500 text-xs line-clamp-2 mt-1">{{ $intent->respuesta_sugerida }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                        @foreach ($intent->preguntas as $pregunta)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                {{ $pregunta->pregunta }}
                            </span>
                        @endforeach
                        @if($intent->preguntas->count() == 0)
                            <span class="text-slate-300 italic text-xs">Sin variantes</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($intent->activo)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Activo</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">Inactivo</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2 text-nowrap">
                    <a href="{{ route('admin.preguntas.edit', $intent) }}" class="text-indigo-600 hover:text-indigo-800 p-2 hover:bg-indigo-50 rounded-lg transition-colors inline-block">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                    <form action="{{ route('admin.preguntas.destroy', $intent) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-800 p-2 hover:bg-rose-50 rounded-lg transition-colors" onclick="return confirm('¿Estás seguro?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">No hay registros aún. Comienza creando uno nuevo.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 bg-slate-50">
        {{ $intentions->links() }}
    </div>
</div>
@endsection
