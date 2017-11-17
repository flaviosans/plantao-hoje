<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'pai'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function filha(){
        return $this->hasMany('App\Categoria', 'pai');
    }

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function pai(){
        return $this->belongsTo('App\Categoria', 'id');
    }

    public function produto(){
        return $this->belongsToMany('\App\Produto');
    }

    public function token(){
        return $this->morphToMany('\App\Token', 'tokenable');
    }

    public static function menu($pai = 0){
        foreach(Categoria::where('pai','=', $pai) as $cada){
            echo $cada->nome;
            self::menu($cada->pai);
        }
    }

    protected static function boot(){
        parent::boot();

        static::deleting(function($categoria){
            $imagens = array();
            foreach($categoria->imagem as $cada){
                array_push($imagens, $cada->caminho);
                $cada->delete();
            }

            foreach($imagens as $imagem){
                File::delete($imagem);
            }

            //foreach($categoria->produto as $produto) {

            $categoria->produto()->detach();
            //}
        });
    }
}
