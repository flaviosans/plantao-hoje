<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'logradouro',
        'bairro',
        'cep_id'
    ];
    
    public function enderecavel(){
        return $this->morphTo();
    }
}
