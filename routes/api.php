<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware('api')->group(function () {
    Route::post('/show_estudiantes', [Controller::class, 'ShowAlumnos'])->name('show_estudiantes');
    Route::post('/show_becas', [Controller::class, 'ShowBecas'])->name('show_becas');
    Route::post('/show_materias', [Controller::class, 'ShowMaterias'])->name('show_materias');
    Route::post('/show_requisitosP', [Controller::class, 'ShowRequisitosP'])->name('show_requisitosP');
    /* relaciones */
    Route::post('/show_requisitos', [Controller::class, 'ShowRequisitos'])->name('show_requisitos');
    Route::post('/show_calificaciones', [Controller::class, 'ShowCalificaciones'])->name('show_calificaciones');
    Route::post('/show_becas_estudiantes', [Controller::class, 'ShowBecasAlumnos'])->name('show_becas_estudiantes');

    Route::post('/new_beca', [Controller::class, 'CreateBeca'])->name('new_beca');
    Route::post('/new_alumno', [Controller::class, 'CreateAlumno'])->name('new_alumno');
    Route::post('/new_materia', [Controller::class, 'CreateMateria'])->name('new_materia');
    Route::post('/new_requisito', [Controller::class, 'CreateRequisito'])->name('new_requisito');

    Route::post('/delete_materia', [Controller::class, 'DeleteMateria'])->name('delete_materia');
    Route::post('/delete_alumno', [Controller::class, 'DeleteAlumno'])->name('delete_alumno');
    Route::post('/delete_beca', [Controller::class, 'DeleteBeca'])->name('delete_beca');
    Route::post('/delete_requisito', [Controller::class, 'DeleteReq'])->name('delete_requisito');

    /* nuevas rel */
    Route::post('/new_becas_requisitos', [Controller::class, 'CreateReqBecas'])->name('new_becas_requisitos');
    Route::post('/new_estudiantes_materias', [Controller::class, 'CreateMatEst'])->name('new_estudiantes_materias');
    Route::post('/new_estudiantes_becas', [Controller::class, 'CreateBecEst'])->name('new_estudiantes_becas');

});
