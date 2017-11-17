<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 13/09/2017
 * Time: 23:22
 */

namespace App\Library;


class Util
{
    public static function extrairTipo($obj){
        $tipo = get_class($obj);
        $tipo = substr($tipo, 4);
        return strtolower($tipo);
    }
}