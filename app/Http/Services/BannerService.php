<?php

namespace App\Http\Services;

use App\Banner;
use App\Imagem;
use App\Interfaces\IBannerService;
use Illuminate\Support\Facades\Auth;

class BannerService implements IBannerService
{
    public function getBanners($paginate = 10)
    {
        return Banner::where('user_id', Auth::id())
            ->paginate(10);
    }

    public function findBanner($id)
    {
        return Banner::find($id);
    }

    public function saveBanner($request)
    {
        $banner = new Banner();
        $banner->fill($request->all());
        $this->bannerService->saveBanner($banner);
        $banner->user_id = Auth::id();
        $banner->save();
        isset($request->imagem) ? Imagem::salvar($request->imagem, $banner) : '' ;
    }

    public function updateBanner($request, $id)
    {
        $banner = Banner::find($id);
        $banner->fill($request->all());
        $banner->save();
        isset($request->imagem) ? Imagem::atualizar($request->imagem, $banner) : '';
    }

    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
    }

}
