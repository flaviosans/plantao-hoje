<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Endereco;
use App\Item;
use App\Marca;
use App\Oferta;
use App\Pedido;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $produto = Produto::where('nome', 'like', '%' . $request->q . '%')
            ->pluck('id')->toArray();

        $dados = [
            'ofertas'=> Oferta::whereIn('produto_id', $produto)->get()
        ];

        return view('front.ofertas', $dados);
    }

    public function checkout(Request $request){
        return view('front.checkout');
    }

    public function pedido(Request $request)
    {
        $pedido = new Pedido();
        $itens = [];
        $id_endereco = $request->input('endereco.endereco_id');
        Auth::user()->pedido()->save($pedido);

        if($id_endereco == 0){
            $endereco = new Endereco();
            $endereco->fill($request->json('endereco'));
            $pedido->endereco()->save($endereco);
            Auth::user()->endereco()->save($endereco);
        } else{
            $endereco = Auth::user()->endereco()->find($id_endereco)->get();
            $pedido->endereco()->save($endereco);
        }

        foreach ($request->json('itens') as $cada) {
            $item = new Item();
            $item->fill($cada);
            $itens[] = $item;
        }

        $pedido->item()->saveMany($itens);

        return $pedido->toJson();
    }

    public function ofertas(){
        $dados = [
            'ofertas'=> Oferta::all()
        ];

        return view('front.ofertas', $dados);
    }
}
