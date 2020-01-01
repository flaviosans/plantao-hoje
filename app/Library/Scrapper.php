<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 16/09/2017
 * Time: 04:07
 */

namespace app\Library;



use App\Marca;
use App\Produto;

class Scrapper
{
    public static function buscarProduto($codigo_barras){
        $produto = self::getProduto($codigo_barras);
        return $produto;
    }

    public static function getProduto($codigo_barras){
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTMLFile('https://cosmos.bluesoft.com.br/produtos/' . $codigo_barras);
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query("//h1[@class='page-header']/text()");
        $produto = new Produto();
        $produto->nome = $nodes[0]->nodeValue;

        $produto->codigo_barras = $codigo_barras;
        libxml_use_internal_errors(false);
        $produto->save();

        return $produto;
    }

    public static function getProdutoo($codigo_barras){
        $html = file_get_contents('https://cosmos.bluesoft.com.br/produtos/' . $codigo_barras);
        $produto = new Produto;
        preg_match("/e>.+- GTIN/", $html,         $nome);

        $produto->nome = substr($nome[0], 2, -7);
        $produto->nome = ucfirst($produto->nome);
        $produto->codigo_barras = $codigo_barras;
        $marca = self::getMarca($html);

        $produto->save();

        return $produto;
    }

    public static function getMarca($html){
     /*   $marca = new Marca;
        preg_match("")
        $marca->nome =*/
    }
}