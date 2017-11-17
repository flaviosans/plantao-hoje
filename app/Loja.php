<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = ['nome'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function endereco()
    {
        return $this->hasMany('\App\Endereco');
    }

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }
    public function produto(){
        return $this->hasMany('\App\Produto');
    }

    public function telefone()
    {
        return $this->hasMany('\App\Telefone');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function oferta(){
        return $this->hasManyThrough('\App\Oferta', '\App\Campanha');
    }
}
