<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    public function produto(){
        return $this->hasMany('\App\Produto');
    }
}
