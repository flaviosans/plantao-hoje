<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{

    protected $fillable = ['nome', 'texto', 'tipo', 'link', 'user_id'];
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function salvarImagem($imagem){
        Imagem::salvar($imagem, $this);
    }

    public function atualizarImagem($imagem){
        if(isset($this->imagem)){

        }
    }


}
