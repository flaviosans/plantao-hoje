<?php

namespace App;

use App\Library\File;
use App\Library\Util;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Imagem extends Model
{
    protected $fillable = ['produto_id'];

    public function dono(){
        return $this->morphTo();
    }

    public static function salvar($arquivo, $obj){
        if($obj->id == null){
            $obj->save();
        }
        $imagem = new Imagem();
        $tipo = Util::extrairTipo($obj);
        $imagem->caminho = File::upload($arquivo, $tipo);
        $obj->imagem()->save($imagem);

    }

    public static function atualizar($arquivo, $obj){
        $imagem = Imagem::firstOrNew(['dono_id'=> $obj->id, 'dono_type'=> get_class($obj)]);
        File::delete($imagem->caminho);
        $imagem->delete();
        self::salvar($arquivo, $obj);
    }

    public static function padrao($obj){
        $imagem = new Imagem();
        $imagem->caminho = '/storage/app/public/media/no.jpg';
        $imagem->save();
        $obj->imagem()->save($imagem);
    }
}
