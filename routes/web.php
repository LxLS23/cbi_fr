<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CanalContactoController;
use App\Http\Controllers\MedioDifusionController;
use App\Http\Controllers\PreguntaFrecuenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('areas', AreaController::class);
    Route::resource('ubicaciones', UbicacionController::class);
    Route::resource('horarios', HorarioController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('canales', CanalContactoController::class);
    Route::resource('medios', MedioDifusionController::class);
    Route::resource('preguntas', PreguntaFrecuenteController::class);
});
