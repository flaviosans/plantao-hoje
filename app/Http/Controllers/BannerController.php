<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IBannerService;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(IBannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $data = [
          'banners'=> $this->bannerService->getBanners()
        ];

        return view('admin.banners.banners', $data);
    }

    public function create()
    {
        return view('admin.banners.form');
    }

    public function store(Request $request)
    {
        $this->bannerService->saveBanner($request);
        return redirect()->route('banners.index');
    }

    public function edit($id)
    {
        $data = [
            'banner'=> $this->bannerService->findBanner($id)
        ];

        return view('admin.banners.form', $data);
    }

    public function update(Request $request, $id)
    {
        $this->bannerService->updateBanner($request, $id);
        return redirect()->route('banners.index');
    }

    public function destroy($id)
    {
        $this->bannerService->deleteBanner($id);
        return redirect()->route('banners.index');

    }
}
