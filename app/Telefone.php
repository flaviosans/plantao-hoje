<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    public function loja(){
        return $this->belongsTo('\App\Loja');
    }
}
