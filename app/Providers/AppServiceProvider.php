<?php

namespace App\Providers;

use App\Http\Interfaces\ILojaService;
use App\Produto;
use App\Observers\ProdutoObserver;
use App\Http\Services\BannerService;
use App\Repositories\BannerRepository;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\LojaService;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Produto::observe(ProdutoObserver::class);
    }

    public function register()
    {
        $this->app->bind(
            ILojaService::class,
            LojaService::class
        );
    }
}
