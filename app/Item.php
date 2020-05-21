<?php

namespace App;

use App\Library\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'produto_id', 'preco_normal', 'preco_promocao', 'quantidade', 'observacao'
    ];

    public function lista(){
        return $this->morphTo();
    }

    public function produto(){
        return $this->belongsTo('\App\Produto');
    }

    public static function por_cotacao($cotacao_id){
        return self::where('cotacao_id', '=', $cotacao_id)->orderBy('id', 'desc');
    }
}
