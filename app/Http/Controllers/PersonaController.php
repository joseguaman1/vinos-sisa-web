<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;

class PersonaController extends Controller
{
    public function listar() {
        //return \App\Models\Persona::all()->toJson();
        //return \App\Models\Persona::where('estado', true)->get();
    }
    
    public function guardar() {
        $persona = new \App\Models\Persona();
        $persona->cedula = Input::get('cedula');
        $persona->apellidos = Input::get('apellidos');
        $persona->nombres = Input::get('nombres');
        $persona->external_id = utilidades\UUID::v4();
        $cuenta = new \App\Models\Cuenta();
        $cuenta->email = Input::get('email');
        $cuenta->clave = Input::get('clave');
        $cuenta->external_id = utilidades\UUID::v4();
        $persona->save();
        $cuenta->persona()->associate($persona);
        $cuenta->token = base64_encode($cuenta->email.'-.-'.$persona->external_id);
        $cuenta->save();
        return redirect('/');
    }
    
}
