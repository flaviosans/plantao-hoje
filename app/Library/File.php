<?php

namespace App\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File
{
    public static function upload($file, $obj){
        $nomeBanner = null;
        $nome = isset($obj->nome) ? $obj->nome : $obj->descricao;
        if($file == null){
            $nomeBanner = 'public/media/produto/no-image.jpg';
        }
        else{
            $nomeBanner = $file
                ->storeAs('public', 'media/'. Util::extrairTipo($obj) . '/' . Stringg::slugfy($nome) . '.'.$file->getClientOriginalExtension());
            $nomeBanner = str_replace('public', '/storage', $nomeBanner);
        }
        return $nomeBanner;
    }

    public static function delete($file){
        $nomeFile = str_replace('/storage', 'public', $file);
        Storage::delete($nomeFile);
    }
}
