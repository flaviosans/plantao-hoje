<?php

namespace App\Providers;

use App\Produto;
use App\Interfaces\IBannerService;
use App\Observers\ProdutoObserver;
use App\Http\Services\BannerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    
    public function boot()
    {
        Produto::observe(ProdutoObserver::class);
    }

    public function register()
    {
        $this->app->bind(IBannerService::class, function(){
            return new BannerService;
        });
    }
}
