<?php

namespace App\Http\Services;

use App\Banner;
use App\Imagem;
use Illuminate\Support\Facades\Auth;

class BannerService
{

    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function getBanners($paginate = 10)
    {
        return $this->bannerRepository->getBanners($paginate);
    }

    public function findBanner($id)
    {
        return $this->bannerRepository->findBanner($id);
    }

    public function saveBanner($request)
    {
        $banner = new Banner();
        $banner->fill($request->all());
        $banner->user_id = Auth::id();
        $this->bannerRepository->saveBanner($banner);
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
