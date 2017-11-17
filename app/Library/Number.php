<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 23/09/2017
 * Time: 09:11
 */

namespace app\Library;


class Number
{
    public static function toDouble($value){
        $value = str_replace(',', '.', $value);
        return $value;
    }

    public static function toCurrency($value){
        $value = str_replace('.', ',', $value);
        return $value;
    }
}