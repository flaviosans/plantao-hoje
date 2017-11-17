<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 12/09/2017
 * Time: 11:51
 */

namespace App\Library;


class Message
{
    private static function mensagem($message, $class, $tipo){
        session()->flash('mensagem', $message);
        session()->flash('class', $class);
        session()->flash('tipo', $tipo);
    }

    public static function info($message){
        self::mensagem($message, 'alert-info', 'Informação');
    }

    public static function warning($message){
        self::mensagem($message, 'alert-warning', 'Atenção');

    }
}