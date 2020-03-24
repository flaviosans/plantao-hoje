<?php

namespace App\Providers;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Pluralizer;

class PluralizarionServiceProvider extends ServiceProvider
{
    public function register()
    {
        Inflector::rules('plural', ['irregular' => ['cotacao' => 'cotacoes']]);
        Inflector::rules('plural', ['irregular' => ['item' => 'itens']]);
    }

}
