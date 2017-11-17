<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 15/11/2017
 * Time: 20:12
 */

namespace app\Observers;


use App\Categoria;

class CategoriaObserver
{
    public function saving(Categoria $categoria){
        $categoria->slug = Slug::slugfy($categoria->titulo);
    }
}