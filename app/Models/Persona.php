<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    //protected $primaryKey = 'id_persona';
    //public $timestamps = false;
    public function cuenta() {
        return $this->hasOne('App\Models\Cuenta', 'id_persona'); 
    }
}
