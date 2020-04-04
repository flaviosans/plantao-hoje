<?php

namespace App;

use App\Library\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oferta extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'produto_id', 'preco_normal', 'preco_promocao', 'quantidade'
    ];

    public function campanha(){
        return $this->belongsTo('\App\Campanha');
    }

    public function produto(){
        return $this->belongsTo('\App\Produto');
    }
}
