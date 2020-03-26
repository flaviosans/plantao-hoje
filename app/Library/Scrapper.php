<?php
/**
 * Created by PhpStorm.
 * User: flavi
 * Date: 16/09/2017
 * Time: 04:07
 */

namespace App\Library;



use App\Marca;
use App\Produto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Scrapper
{
    public static function scrap($codigo_barras){
        $produto = Produto::where('codigo_barras', '=', $codigo_barras);
        if($produto->count() != 0){
            Message::warning("Produto já existe!");
            return;
        }
        $xpath = self::getDomXPath('https://cosmos.bluesoft.com.br/produtos/' . $codigo_barras);
        self::buscarImagem($xpath);
        return self::buscarProduto($xpath, $codigo_barras);

    }

    private static function buscarProduto($xpath, $codigo_barras){
        $node_nome = $xpath->query("//h1[@class='page-header']/text()");
        $produto = new Produto();
        $produto->nome = $node_nome[0]->nodeValue;
        $produto->codigo_barras = $codigo_barras;
        $produto->marca()->associate(self::buscarMarca($xpath));
        // $produto->salvarImagem(self::buscarImagem($xpath));
        $produto->save();

        return $produto;
    }

    public static function buscarMarca($xpath){
        $node_nome = $xpath->query("//span[@class='brand-name']/a/text()");
        $marca = Marca::firstOrCreate([
            'nome' => $node_nome[0]->nodeValue
        ]);

        $marca->save();
        return $marca;
    }

    private static function buscarImagem($xpath){
        $node_imagem = $xpath->query("//div[contains(@class, 'product-thumbnail')]/img/@src");
        $info = pathinfo($node_imagem[0]->nodeValue);
        $file = 'public\\storage\\media\\' . $info['basename'];
        Storage::putFile('testandoooo', new \Illuminate\Http\File($node_imagem[0]->nodeValue));

        return new UploadedFile($file, $info['basename']);
    }

    private static function getDomXPath($url){
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $file = file_get_contents($url);
        $dom->loadHTML( '<?xml encoding="UTF-8">' . $file);
        libxml_use_internal_errors(false);
        return new \DOMXPath($dom);
    }
}