<?php

namespace App;

use \App\Library\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Oferta;

class Campanha extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo', 'descricao', 'validade'
    ];

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function setValidadeAttribute($value){
        $this->attributes['validade'] = Date::toUTF($value);
    }

    public function oferta(){
        return $this->hasMany(Oferta::class);
    }

    public function oferta(){
        return $this->belongsTo('\App\Oferta');
    }

    protected static function boot(){
        parent::boot();
        static::deleting(function($campanha){
            if (isset($campanha->item) && is_array($campanha->item)) {
                foreach($campanha->item as $item){
                    $item->delete();
                }
            }
        });
    }

    public function getQuantasOfertasAttribute(){
        return $this->oferta()->count();
    }


}
