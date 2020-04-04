<?php

namespace App;

use App\Library\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    protected $fillable =   ['nome', 'codigo_barras', 'marca_id', 'loja_id', 'medida_id'];
    protected $guarded =    ['id', 'updated_at', 'created_at'];
    protected $appends =    ['tags', 'text'];
    protected $hidden =     ['created_at', 'updated_at', 'marca_id', 'loja_id'];
    protected $dates =      ['created_at', 'updated_at', 'deleted_at'];
    
    public function getQuantasItensAttribute(){
        return $this->item->count();
    }

    public function getProdutoAttribute(){
        return $this;
    }

    public function possui($categoria){
        return in_array($categoria->id, $this->categoria->pluck('id')->toArray());
    }

    public function categoria(){
        return $this->belongsToMany('\App\Categoria');
    }

    public function imagem(){
        return $this->morphMany('\App\Imagem', 'dono');
    }

    public function item(){
        return $this->hasMany('\App\Item');
    }

    public function loja(){
        return $this->belongsTo('\App\Loja');
    }

    public function marca(){
        return $this->belongsTo('\App\Marca');
    }

    public function medida(){
        return $this->belongsTo('\App\Medida');
    }

    public function oferta(){
        return $this->hasMany('\App\Oferta');
    }

    public function tag(){
        return $this->belongsToMany('\App\Tag');
    }

    public function token(){
        return $this->morphToMany('\App\Token', 'tokenable');
    }

    public function getTagsAttribute(){
        $string = '';
        foreach($this->tag as $tag){
            $string.= $tag->nome . ',';
        }
        return substr($string,0, -1);
    }

    public function getTextAttribute(){
        return $this->nome;
    }

    public function atualizarTags($tags){
        $tags = str_replace([' ,', ', ', ' , '],',', $tags);
        $tags = explode(',', $tags);

        $idNovasTags = array();
        foreach($tags as $tag){
            array_push($idNovasTags, Tag::firstOrCreate(['nome'=> $tag])->id);
        }

        $this->tag()->sync($idNovasTags);
    }

    public function criarTags($tags){
        $tags = str_replace([' ,', ', ', ' , '],',', $tags);
        $tags = explode(',', $tags);
        foreach($tags as $tag){
            $nova = Tag::firstOrNew(['nome'=> $tag]);
            $this->tag()->attach($nova->id);
        }
    }

    public function criarTokens(){
        $nome = str_replace([' ,', ', ', ' , ', ' '], ',', $this->nome);
        $nome = explode(',', $nome);
        foreach($nome as $item){
            $nova = Token::firstOrCreate(['token'=> $item]);
            $this->token()->attach($nova);
        }
    }

    public function semImagem(){
        $this->imagem = new Imagem();
        $this->imagem()->caminho = '/storage/media/no.jpg';
        $this->imagem()->save();
    }

    public function salvarCategorias($categorias){
        if(is_array($categorias)){
            foreach($categorias as $categoria){
                $this->categoria()->save(Categoria::findOrFail($categoria));
            }
        }
        else{
            $this->categoria()->save()(Categoria::findOrFail($categorias));
        }
    }

    public function salvarImagem($imagem){
        Imagem::salvar($imagem, $this);
    }
}