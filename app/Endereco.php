<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function loja(){
        return $this->belongsTo('\App\Loja');
    }
}
