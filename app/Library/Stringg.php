<?php


namespace App\Library;


class Stringg
{
    public static function capitalize($string){
        $string = ucfirst(strtolower($string));
        return $string;
    }
}