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
Route::post('buscador', 'MapaController@buscarDescripcion')->name('filtrarDescripcion');

// FORMULARIO

Route::post('Formulario', 'FormularioController@ingresar')->name('ingresarFormulario');
Route::get('/IngresarFormulario', 'MapaController@seleccionarPosicion')->name('formulario');



Route::post('/subir','FormularioController@subirArchivo')->name('subir');

Route::group(['middleware' => 'auth'], function(){

// ADMINISTRADOR

    Route::get('Administrador', 'AdministradorController@mostrarDatos')->name('Administrador');

    Route::get('Administrador/aceptar/{id}','AdministradorController@aceptar');
    Route::get('Administrador/aceptarMasa','AdministradorController@aceptarMasa');
    Route::delete('Administrador/rechazar/{id}','AdministradorController@rechazar')->name('administradorRechazar');
    Route::get('Administrador/rechazarMasa','AdministradorController@rechazarMasa');
    Route::get('Administrador/editar/{id}','MapaController@editarMapa');

    Route::get('Administrador/Aprobados','AdministradorController@aprobados');

    Route::get('Administrador/editarAprobado/{id}','MapaController@editarMapaAdmin');

    Route::delete('Administrador/eliminar/{id}','AdministradorController@eliminar')->name('administradorEliminar');

    Route::get('Administrador/PalabrasProhibidas','AdministradorController@palabrasProhibidas');
    Route::post('Administrador/PalabrasProhibidas', 'AdministradorController@ingresarInsulto')->name('ingresarInsulto');

    Route::get('Administrador/HistorialRechazados','AdministradorController@historialRechazados');

    Route::get('Administrador/AgregarAdministrador','AdministradorController@ingresarDatosAdministrador');

    Route::post('/NuevoAdministrador', 'AdministradorController@agregarAdministrador')->name('nuevoAdministrador');

    Route::get('formularios/export/', 'ExcelController@exportarAprobados')->name('exportarFormulario');

    Route::get('Administrador/recuperar/{id}','AdministradorController@recuperarRechazado');

    Route::get('formularios/borrar/', 'AdministradorController@borrarHistorial')->name('borrarHistorial');

    //FORMULARIO ADMINISTRADOR

    Route::post('Administrador', 'FormularioController@actualizarPendiente')->name('actualizarFormularioPendiente');
    Route::get('/ActualizarFormulario', function () {
        return view('Administrador/Administrador', compact('id'));
    });

    Route::post('AdministradorAprobados', 'FormularioController@actualizarAprobado')->name('actualizarFormularioAprobado');
    Route::get('/ActualizarFormularioAprobado', function () {
        return view('Administrador/Administrador', compact('id'));
    });

});

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

// CAMBIAR CONTRASEÑA

Route::get('/RecuperarContraseña', 'ContraseñaController@menuRecuperar')->name('recuperarContraseña');
Route::post('/Contraseña', 'ContraseñaController@generarCodigo')->name('codigoContraseña');

Route::get('/Contraseña', function () {
    return view('Contraseña/CambiarContraseña');
});

Route::post('/NuevaContraseña', 'ContraseñaController@nuevaContraseña')->name('nuevaContraseña');






