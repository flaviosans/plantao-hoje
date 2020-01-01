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
        $xpath = self::getDomXPath('https://cosmos.bluesoft.com.br/produtos/' . $codigo_barras);
        $node_nome = $xpath->query("//h1[@class='page-header']/text()");

        $produto = new Produto();
        $produto->nome = $node_nome[0]->nodeValue;
        $produto->codigo_barras = $codigo_barras;
        $produto->save();

        return $produto;
    }

    public static function getDomXPath($filename){
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTMLFile($filename);
        libxml_use_internal_errors(false);
        return new \DOMXPath($dom);
    }
}