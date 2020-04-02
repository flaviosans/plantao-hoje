<?php

namespace App\Providers;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\ServiceProvider;

class PluralizationServiceProvider extends ServiceProvider
{
    public function register()
    {
        Inflector::rules('plural', ['irregular' => [
            'cotacao' => 'cotacoes',
            'item' => 'itens',
            'enderecavel' => 'enderecaveis',
            'petivel' => 'petiveis'
        ]]);
    }
}
