<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 21/09/2017
 * Time: 21:14
 */

namespace App\Observers;

use App\Library\File;
use App\Produto;

class ProdutoObserver
{
    public function created(Produto $produto){
        $produto->criarTokens();
    }

    public function deleting(Produto $produto){
        $imagens = array();
        foreach($produto->imagem as $cada){
            array_push($imagens, $cada->caminho);
            $cada->delete();
        }

        foreach($imagens as $imagem){
            File::delete($imagem);
        }

        foreach($produto->oferta as $cada){
            $cada->delete();
        }

        //foreach($produto->categoria as $categoria) {
        $produto->categoria()->detach();
        //}

        $produto->marca()->dissociate();

        $produto->tag()->detach();
    }
}