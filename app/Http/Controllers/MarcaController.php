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
    //put your code here
    public function index() {
        $data['lista'] = \App\Models\Marca::all();
        return view("fragmentos.marcas.frm_lista_marcas", $data);
    }
}
