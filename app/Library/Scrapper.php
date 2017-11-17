<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 16/09/2017
 * Time: 04:07
 */

namespace app\Library;



use App\Produto;

class Scrapper
{
    public static function buscarProduto($codigo_barras){
        $produto = self::getProduto($codigo_barras);
        return $produto;
    }


    public static function getProduto($codigo_barras){
        $html = file_get_contents('https://cosmos.bluesoft.com.br/produtos/' . $codigo_barras);
        $produto = new Produto;
        preg_match("/e>.+- GTIN/", $html,         $nome);
        preg_match("/[0-9]{13}/", $html, $codigo_barras);

        $produto->nome = substr($nome[0], 2, -7);
        $produto->codigo_barras = $codigo_barras[0];

        $produto->save();

        return $produto;
    }
}