<?php


namespace App\Repositories;


use App\Banner;
use App\Interfaces\IBannerRepository;
use Illuminate\Support\Facades\Auth;

class BannerRepository implements IBannerRepository
{

    public function getBanners($paginate = 10)
    {
        return Banner::where('user_id', Auth::id())
            ->paginate($paginate);
    }

    public function findBanner($id)
    {
        return Banner::find($id);
    }

    public function saveBanner(Banner $banner)
    {
        return $banner->save();
    }

    public function updateBanner($request, $id)
    {
        // TODO: Implement updateBanner() method.
    }

    public function deleteBanner($id)
    {
        // TODO: Implement deleteBanner() method.
    }
}