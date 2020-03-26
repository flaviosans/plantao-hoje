<?php

namespace App;

use App\Library\Message;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Marca extends Model
{
    protected $fillable = ['nome'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }
    
    public function produto(){
        return $this->hasMany('\App\Produto');
    }
    
    public function token(){
        return $this->morphMany('\App\Token', 'tokenable');
    }
    

    protected static function boot(){
        parent::boot();

        static::deleting(function($marca){
            $imagens = array();
            foreach($marca->imagem as $cada){
                array_push($imagens, $cada->caminho);
                $cada->delete();
            }

            foreach($imagens as $imagem){
                File::delete($imagem);
            }
        });
    }
}
