<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Marca;
use App\Oferta;
use App\Produto;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $dados = array(
            'ofertas'=> Oferta::orderBy('created_at', 'desc')->take(6)->get(),
            'marcas'=> Marca::all(),
            'bannerTopo'=> Banner::where('tipo', 1)->get(),
            'bannerMeio'=> Banner::where('tipo', 2)->get()
        );

        return view('front.index', $dados);
    }

    public function busca(Request $request){
        $produto = Produto::where('nome', 'like', '%' . $request->termo . '%')->pluck('id')->toArray();
        $dados = [
            'ofertas'=> Oferta::whereIn('produto_id', $produto)->get()
        ];

        return view('front.ofertas', $dados);
    }

    public function ofertas(){
        $dados = [
            'ofertas'=> Oferta::all()
        ];

        return view('front.ofertas', $dados);
    }
}
