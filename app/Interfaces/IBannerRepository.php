<?php


namespace App\Interfaces;


use App\Banner;

interface IBannerRepository
{
    public function getBanners($paginate = 10);

    public function findBanner($id);

    public function saveBanner(Banner $banner);

    public function updateBanner($request, $id);

    public function deleteBanner($id);
}