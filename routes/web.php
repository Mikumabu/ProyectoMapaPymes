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

// MAPA

Route::get('/', 'MapaController@maps');
Route::get('/Mapa', 'MapaController@maps');
Route::get('/TestMapa', 'MapaController@test');

Route::get('/Formulario', function () {
    return view('Formulario/Formulario');
});

Route::post('buscar', 'MapaController@buscador')->name('filtrar');
Route::get('/BuscarDatos', function () {
    return view('Mapa/MapaFiltrado', compact('categoria'));
});

// FORMULARIO

Route::post('Formulario', 'FormularioController@ingresar')->name('ingresarFormulario');
Route::get('/IngresarFormulario', 'MapaController@seleccionarPosicion')->name('formulario');

Route::post('Administrador', 'FormularioController@actualizarPendiente')->name('actualizarFormularioPendiente');
Route::get('/ActualizarFormulario', function () {
    return view('Administrador/Administrador', compact('id'));
});

Route::post('AdministradorAprobados', 'FormularioController@actualizarAprobado')->name('actualizarFormularioAprobado');
Route::get('/ActualizarFormularioAprobado', function () {
    return view('Administrador/Administrador', compact('id'));
});

Route::group(['middleware' => 'auth'], function(){


// ADMINISTRADOR

    Route::get('Administrador', 'AdministradorController@mostrarDatos');

    Route::get('Administrador/aceptar/{id}','AdministradorController@aceptar');
    Route::get('Administrador/rechazar/{id}','AdministradorController@rechazar');
    Route::get('Administrador/editar/{id}','MapaController@editarMapa');

    Route::get('Administrador/Aprobados','AdministradorController@aprobados');
    Route::get('Administrador/editarAprobado/{id}','MapaController@editarMapaAdmin');
    Route::get('Administrador/eliminar/{id}','AdministradorController@eliminar');
});


// EMAIL

Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

// EXCEL

Route::get('formularios/export/', 'ExcelController@exportarAprobados')->name('exportarFormulario');

