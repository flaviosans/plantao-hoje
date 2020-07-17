<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BannerService;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $dados = [
          'banners'=> $this->bannerService->getBanners()
        ];

        return view('admin.banners.banners', $dados);
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
        $dados = [
            'banner'=> $this->bannerService->findBanner($id)
        ];

        return view('admin.banners.form', $dados);
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
