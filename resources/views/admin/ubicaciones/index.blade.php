@extends('layouts.app')

@section('title', 'Gestión de Ubicaciones')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h3 class="text-2xl font-bold text-slate-800">Ubicaciones Físicas</h3>
        <p class="text-slate-500 text-sm">Registro de pisos, módulos y referencias físicas.</p>
    </div>
    <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all duration-200">
        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nueva Ubicación
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm shadow-slate-100 overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold text-[11px] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Ubicación Física</th>
                <th class="px-6 py-4">Piso / Módulo</th>
                <th class="px-6 py-4 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($ubicaciones as $ubicacion)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <span class="font-semibold text-slate-700">{{ $ubicacion->ubicacion_fisica }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-slate-500 text-sm">{{ $ubicacion->referencia_piso_modulo ?? 'N/A' }}</span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <button data-modal-target="edit-modal-{{ $ubicacion->id }}" data-modal-toggle="edit-modal-{{ $ubicacion->id }}" class="text-indigo-600 hover:text-indigo-800 p-2 hover:bg-indigo-50 rounded-lg transition-colors inline-block">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <form action="{{ route('admin.ubicaciones.destroy', $ubicacion) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-800 p-2 hover:bg-rose-50 rounded-lg transition-colors" onclick="return confirm('¿Estás seguro?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div id="edit-modal-{{ $ubicacion->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-3xl shadow-2xl">
                        <div class="flex items-center justify-between p-6 border-b border-slate-100 rounded-t-3xl">
                            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Editar Ubicación</h3>
                            <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors" data-modal-hide="edit-modal-{{ $ubicacion->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                            </button>
                        </div>
                        <form action="{{ route('admin.ubicaciones.update', $ubicacion) }}" method="POST" class="p-6">
                            @csrf @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700">Ubicación Física</label>
                                    <input type="text" name="ubicacion_fisica" value="{{ $ubicacion->ubicacion_fisica }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700">Piso / Módulo</label>
                                    <input type="text" name="referencia_piso_modulo" value="{{ $ubicacion->referencia_piso_modulo }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400">
                                </div>
                                <div class="flex space-x-3 pt-4">
                                    <button type="button" data-modal-hide="edit-modal-{{ $ubicacion->id }}" class="flex-1 px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Cancelar</button>
                                    <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100 transition-all">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic">No hay ubicaciones registradas aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 bg-slate-50">
        {{ $ubicaciones->links() }}
    </div>
</div>

<!-- Create Modal -->
<div id="create-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-3xl shadow-2xl">
            <div class="flex items-center justify-between p-6 border-b border-slate-100 rounded-t-3xl">
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Crear Nueva Ubicación</h3>
                <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors" data-modal-hide="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.ubicaciones.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Ubicación Física</label>
                        <input type="text" name="ubicacion_fisica" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400" placeholder="Ej. Edificio A" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Piso / Módulo</label>
                        <input type="text" name="referencia_piso_modulo" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400" placeholder="Ej. Piso 2, Módulo 5">
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" data-modal-hide="create-modal" class="flex-1 px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">Cancelar</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100 transition-all">Crear Ubicación</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
