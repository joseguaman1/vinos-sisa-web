<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
/**
 * Description of AutentificaacionController
 *
 * @author sissysebas
 */
class AutentificacionController extends Controller {
    //put your code here
    public function iniciar_sesion() {
        $correo = Input::get('correo');
        $clave = Input::get('clave');
        $cuentaValidar = \App\Models\Cuenta::where('email', $correo)->first();
        if($cuentaValidar) {
            $cuenta = \App\Models\Cuenta::find($cuentaValidar->id);
            if($clave == $cuenta->clave) {
                //$datos = array("external_id"=>$cuenta->external_id, "nombre" => $cuenta->persona->apellidos);                
                $cuenta->clave = "";                
                Auth::login($cuenta);                
                return redirect('/principal');
            } else {
                return redirect('/')->with('error', 'Tu clave no coincide');
            }
        } else {
            return redirect('/')->with('error', 'Tu cuenta no existe');
        }
    }
    
    public function ingresar() {    
        
        return view('fragmentos.principal.frm_principal');
    }
}
