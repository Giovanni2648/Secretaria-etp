<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\AlumnosController;

Route::controller(AlumnosController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/eliminar/','eliminar')->name('eliminar');
    //Alumno
    Route::get('/alumno/','create_alumno')->name('alumno');
    Route::post('/guardar-alumno/','store_alumno')->name('store-alumno');

    //Profesor
    Route::get('/Profesor/','create_profesor')->name('Profesor');
    Route::post('/guardar-profesor/','store_profesor')->name('store-profesor');
    Route::get('/guardar-profesor2/','store_profesor2')->name('store-profesor2');

    //Buscador
    Route::get('/buscar/','buscador')->name('buscador');

    Route::get('/panel-actualizacion-alumno/','show_update_alumno')->name('show_update_alumno');
    Route::get('/actualizar-alumno/','update_alumno')->name('update_alumno');

    Route::get('/panel-actualizacion-tutor/','show_update_tutor')->name('show_update_tutor');
    Route::get('/actualizar-tutor/','update_tutor')->name('update_tutor');

    Route::get('/panel-actualizacion-profesor/','show_update_profesor')->name('show_update_profesor');
    Route::get('/actualizar-profesor/','update_profesor')->name('update_profesor');

    Route::get('/eliminar-alumno/','delete_alumno')->name('delete_alumno');
    Route::get('/eliminar-tutor/','delete_tutor')->name('delete_tutor');
    Route::get('/eliminar-profesor/','delete_profesor')->name('delete_profesor');
});
