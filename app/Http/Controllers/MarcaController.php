<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
/**
 * Description of MarcaController
 *
 * @author sissysebas
 */
class MarcaController  extends Controller {
    public function __construct() {
        $this->middleware('auth');
    
    }
       
    public function validarNombre() {
        $dato = Input::get('dato');
        
        $lista = \App\Models\Marca::where('nombre', trim($dato))->get();
        if($lista->count() > 0) {
            return response()->json(["existe"=>1], 200);
        } else {
            return response()->json(["existe"=>0], 200);
        }
    }

    //put your code here
    public function index() {
        $data['lista'] = \App\Models\Marca::all();
        return view("fragmentos.marcas.frm_lista_marcas", $data);
    }
    public function guardar() {
        $external = Input::get('external');
        $nombre = Input::get('nombre_marca');        
        $msg = "Se ha guardado correctamente";
        if($external == 0) {
            $marca = new \App\Models\Marca();
            $marca->external_id = utilidades\UUID::v4();
        } else {
            $marcaAux = \App\Models\Marca::where('external_id', $external)->first();
            $marca = \App\Models\Marca::find($marcaAux->id);
            $msg = "Se ha modificado correctamente";
        }        
        $marca->nombre = $nombre;        
        $marca->save();
        return redirect('/administrar/marcas')->with("ok", $msg);
    }    
    
    
}
