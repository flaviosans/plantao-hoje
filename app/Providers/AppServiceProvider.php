<?php

namespace App\Providers;

use App\Interfaces\IBannerRepository;
use App\Produto;
use App\Interfaces\IBannerService;
use App\Observers\ProdutoObserver;
use App\Http\Services\BannerService;
use App\Repositories\BannerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Produto::observe(ProdutoObserver::class);
    }

    public function register()
    {
        $this->app->bind(IBannerRepository::class, function (){
           return new BannerRepository();
        });
        $this->app->bind(IBannerService::class, function($app){
            return new BannerService($app->make(IBannerRepository::class));
        });
    }
}
