<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'descricao',
        'logradouro',
        'bairro',
        'cep'
    ];
    
    public function user(){
        return $this->morphedByMany('\App\User', 'enderecavel');
    }

    public function pedido(){
        return $this->morphedByMany('\App\Pedido', 'enderecavel');
    }
}
