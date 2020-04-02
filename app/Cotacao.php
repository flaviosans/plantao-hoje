<?php

namespace App;

use \App\Library\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cotacao extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo', 'descricao','tipo', 'maximo', 'cotacao_id', 'validade'
    ];

    protected $dates = ['deleted_at'];

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function item(){
        return $this->morphMany('\App\Item', 'lista');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function setValidadeAttribute($value){
        $this->attributes['validade'] = Date::toUTF($value);
    }

    protected static function boot(){
        parent::boot();
    }

    public function getQuantasItensAttribute(){
        return $this->item()->count();
    }

    public static function enviadas(){
        return self::where([
            ['status', '=', Status::PUBLICADA],
            ['user_id', '=', Auth::user()->id]
        ]);
    }

    public static function todas(){
        return self::where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'desc');
    }

    public static function recebidas(){
        $proprias = self::proprias()->pluck('id');
        return self::where('status', '=', Status::PUBLICADA)
            ->whereIn('cotacao_id', $proprias)
            ->orderBy('created_at', 'desc');
    }

    public static function publicadas(){
        return self::where([
            ['status', '=', Status::PUBLICADA],
            ['tipo', '=', 'cliente'],
            ['user_id', '<>', Auth::user()->id]
        ])
            ->orderBy('created_at', 'desc');
    }

    public static function resposta($id){
        return self::where([
            ['cotacao_id', '=', $id],
            ['status', '=', Status::PUBLICADA]
        ])->orderBy('created_at', 'desc');
    }

    public static function proprias(){
        return self::where('user_id','=', Auth::user()->id)->orderBy('created_at', 'desc');
    }

    public function e_propria(){
        return $this->user_id == Auth::user()->id;
    }
}
