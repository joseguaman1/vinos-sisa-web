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
Auth::routes();
Route::get('/', function () {
    if(auth()->check()) {
        return view('fragmentos.principal.frm_principal');
    } else {
        return view('fragmentos.inicio_sesion.login');
    }
    
});

Route::get('/registro', function () {
    return view('fragmentos.inicio_sesion.registro');
});

Route::get('/administrar/persona/prueba/{sisa}', "PersonaController@test");
Route::get('/administrar/persona/listado', "PersonaController@listar");
Route::post('/administrar/persona/save', "PersonaController@guardar");

Route::post('/inicior_sesion', "AutentificacionController@iniciar_sesion");
Route::get('/principal', "AutentificacionController@ingresar");

Route::get('/cerrar_sesion', "AutentificacionController@cerrar_sesion");

Route::get('/administrar/marcas', "MarcaController@index");