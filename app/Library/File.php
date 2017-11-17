<?php

namespace App\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File
{
    public static function upload($file, $tipo){
        $nomeBanner = null;
        if($file == null){
            $nomeBanner = 'public/media/produto/no.jpg';
        }
        else{
            $nomeBanner = $file
                ->storeAs('public', 'media/'. $tipo . '/' . str_random(5) . '.'.$file->getClientOriginalExtension());
            $nomeBanner = str_replace('public', '/storage', $nomeBanner);
        }
        return $nomeBanner;
    }

    public static function delete($file){
        $nomeFile = str_replace('/storage', 'public', $file);
        Storage::delete($nomeFile);
    }
}
