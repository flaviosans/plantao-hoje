<?php

namespace App\Providers;

use App\Produto;
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

    }
}
