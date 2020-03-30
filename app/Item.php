<?php

namespace App;

use App\Library\Number;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['produto_id', 'preco', 'quantidade', 'observacao'];
    protected $table = 'itens';

    public function cotacao(){
        return $this->belongsTo('\App\Cotacao');
    }

    public function produto(){
        return $this->belongsTo('\App\Produto');
    }

    public function setPrecoAttribute($value){

        $this->attributes['preco'] = Number::toDouble($value);
    }

    public function getPrecoAttribute(){
        if(!isset($this->attributes['preco']))
            $this->attributes['preco'] = Number::toCurrency(0);
        return Number::toCurrency($this->attributes['preco']);
    }

    public static function por_cotacao($cotacao_id){
        return self::where('cotacao_id', '=', $cotacao_id)->orderBy('id', 'desc');
    }
}
