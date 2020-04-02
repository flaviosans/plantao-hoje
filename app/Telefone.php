<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = [
        'numero'
    ];

    public function user(){
        return $this->morphedByMany('\App\User', 'telefonavel');
    }

    public function pedido(){
        return $this->morphedByMany('\App\Pedido', 'telefonavel');
    }
}
