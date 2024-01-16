<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;

Route::controller(AlumnosController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/eliminar/','eliminar')->name('eliminar');
    //Alumno
    Route::get('dashboard-alumnos', 'dashboard_alumnos')->name('dashboard-alumnos');
    Route::post('/guardar-alumno/','store_alumno')->name('store-alumno');

    //Tutor
    Route::post('/guardar-tutor/','store_tutor')->name('store-tutor');

    //Profesor
    Route::post('/crear-profesor/','create_profesor')->name('create-profesor');
    Route::post('/guardar-profesor/','store_profesor')->name('store-profesor');

    //Buscador
    Route::get('/buscar-alumno/','buscador_alumnos')->name('buscador');

    Route::get('/panel-actualizacion-alumno/{id}','show_update_alumno')->name('show_update_alumno');
    Route::get('/actualizar-alumno/','update_alumno')->name('update_alumno');

    Route::get('/panel-actualizacion-tutor/','show_update_tutor')->name('show_update_tutor');
    Route::get('/actualizar-tutor/','update_tutor')->name('update_tutor');

    Route::get('/panel-actualizacion-profesor/','show_update_profesor')->name('show_update_profesor');
    Route::get('/actualizar-profesor/','update_profesor')->name('update_profesor');

    Route::get('/eliminar-alumno/{id}','delete_alumno')->name('delete_alumno');
    Route::get('/eliminar-tutor/','delete_tutor')->name('delete_tutor');
    Route::get('/eliminar-profesor/','delete_profesor')->name('delete_profesor');
});
