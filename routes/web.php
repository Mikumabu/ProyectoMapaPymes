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

Route::get('/Mapa', 'MapaController@maps');

Route::get('/Formulario', function () {
    return view('Formulario/Formulario');
});

Route::get('Administrador', 'AdministradorController@mostrarDatos');

Route::post('Formulario', 'FormularioController@ingresar')->name('ingresarFormulario');
Route::get('/IngresarFormulario', function () {
    return view('Formulario/Formulario');
});

Route::post('Administrador', 'FormularioController@aceptar')->name('aceptarFormulario');
Route::get('/AceptarFormulario', function () {
    return view('Administrador/Administrador');
});




Route::resource('admin', 'AdministradorController');
