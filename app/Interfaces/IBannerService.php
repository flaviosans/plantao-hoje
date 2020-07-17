<?php
namespace App\Interfaces;

interface IBannerService
{
    public function getBanners($paginate = 10);

    public function findBanner($id);

    public function saveBanner($request);

    public function updateBanner($request, $id);

    public function deleteBanner($id);
}