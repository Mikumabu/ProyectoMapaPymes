<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Cornford\Googlmapper\Facades\MapperFacade;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

// MAPA

Route::get('/Mapa', 'MapaController@maps');

Route::get('/Formulario', function () {
    return view('Formulario/Formulario');
});

// FORMULARIO

Route::post('Formulario', 'FormularioController@ingresar')->name('ingresarFormulario');
Route::get('/IngresarFormulario', function () {
    return view('Formulario/Formulario');
});

Route::post('Administrador', 'FormularioController@actualizar')->name('actualizarFormulario');
Route::get('/ActualizarFormulario', function () {
    return view('Administrador/Administrador');
});

// ADMINISTRADOR

Route::get('Administrador', 'AdministradorController@mostrarDatos');

Route::get('Administrador/aceptar/{id}','AdministradorController@aceptar');
Route::get('Administrador/eliminar/{id}','AdministradorController@eliminar');
Route::get('Administrador/detalles/{id}','AdministradorController@mostrarDetalles');
Route::get('Administrador/editar/{id}','AdministradorController@editar');

;
