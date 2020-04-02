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

/*    public function setPrecoNormalAttribute($value){
        $this->attributes['preco_normal'] = Number::toDouble($value);
    }

    public function getPrecoNormalAttribute(){
        return Number::toCurrency($this->attributes['preco_normal']);
    }

    public function setPrecoPromocaoAttribute($value){
        $this->attributes['preco_promocao'] = Number::toDouble($value);
    }

    public function getPrecoPromocaoAttribute(){
        return Number::toCurrency($this->attributes['preco_promocao']);
    }

    public function getPrecoPromocaoRawAttribute(){
        return $this->attributes['preco_promocao'];
    }*/
}
