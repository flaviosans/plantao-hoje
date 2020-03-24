<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Imagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Message;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = [
          'banners'=> Banner::where('user_id', Auth::id())->paginate(10)
        ];

        return view('admin.banners.banners', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner();
        $banner->fill($request->all());
        $banner->user_id = Auth::id();
        $banner->save();
        isset($request->imagem) ? Imagem::salvar($request->imagem, $banner) : '' ;
        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = [
            'banner'=> Banner::find($id)
        ];

        return view('admin.banners.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->fill($request->all());
        $banner->save();
        isset($request->imagem) ? Imagem::atualizar($request->imagem, $banner) : '';

        return redirect()->route('banners.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();

        return redirect()->route('banners.index');

    }
}
