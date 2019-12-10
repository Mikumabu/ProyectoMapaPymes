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

Route::post('Administrador', 'FormularioController@actualizarPendiente')->name('actualizarFormularioPendiente');
Route::get('/ActualizarFormulario', function () {
    return view('Administrador/Administrador', compact('id'));
});

Route::post('AdministradorAprobados', 'FormularioController@actualizarAprobado')->name('actualizarFormularioAprobado');
Route::get('/ActualizarFormularioAprobado', function () {
    return view('Administrador/Administrador', compact('id'));
});


// ADMINISTRADOR

Route::get('Administrador', 'AdministradorController@mostrarDatos');

Route::get('Administrador/aceptar/{id}','AdministradorController@aceptar');
Route::get('Administrador/rechazar/{id}','AdministradorController@rechazar');
Route::get('Administrador/detalles/{id}','AdministradorController@mostrarDetalles');
Route::get('Administrador/editar/{id}','AdministradorController@editar');

Route::get('Administrador/Aprobados','AdministradorController@aprobados');
Route::get('Administrador/editarAprobado/{id}','AdministradorController@editarAprobado');
Route::get('Administrador/eliminar/{id}','AdministradorController@eliminar');
Route::get('Administrador/detallesAprobados/{id}','AdministradorController@mostrarDetallesAprobados');

;

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
