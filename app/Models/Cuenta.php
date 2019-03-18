<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cuenta extends Authenticatable {

    use Notifiable;

    //
    protected $table = 'cuenta';

    public function persona() {
        return $this->belongsTo('App\Models\Persona', 'id_persona');
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value) {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

}
