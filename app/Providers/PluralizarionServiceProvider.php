<?php

namespace App\Providers;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\ServiceProvider;

class PluralizarionServiceProvider extends ServiceProvider
{
    public function register()
    {
        Inflector::rules('plural', ['irregular' => [
            'cotacao' => 'cotacoes',
            'item' => 'itens',
            'enderecavel' => 'enderecaveis'
        ]]);
    }
}
