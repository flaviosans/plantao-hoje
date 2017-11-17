<?php

namespace App;

use \App\Library\Date;
use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    protected $fillable = ['titulo', 'descricao', 'validade'];

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function setValidadeAttribute($value){
        $this->attributes['validade'] = Date::toUTF($value);
    }

    public function oferta(){
        return $this->hasMany('\App\Oferta');
    }

    protected static function boot(){
        parent::boot();

/*        static::deleting(function($campanha){
            $ofertas = array();
            foreach($campanha->oferta as $oferta){
                $oferta->delete();
            }
        });*/
    }

    public function getQuantasOfertasAttribute(){
        return $this->oferta()->count();
    }


}
