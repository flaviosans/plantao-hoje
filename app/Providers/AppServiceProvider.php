<?php

namespace App\Providers;

use App\Http\Interfaces\ILojaService;
use App\Produto;
use App\Observers\ProdutoObserver;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\LojaService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Produto::observe(ProdutoObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ILojaService::class,
            LojaService::class
        );
    }
}
