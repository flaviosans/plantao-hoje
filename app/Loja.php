<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = ['nome'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function endereco(){
        return $this->morphToMany('\App\Endereco', 'enderecavel');
    }

    public function telefone(){
        return $this->morphMany('\App\Telefone', 'telefonavel');
    }

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function produto(){
        return $this->hasMany('\App\Produto');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function item(){
        return $this->hasManyThrough('\App\Item', '\App\Cotacao');
    }
}
