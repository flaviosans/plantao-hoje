<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Cotacao;
use App\Endereco;
use App\Item;
use App\Marca;
use App\Oferta;
use App\Pedido;
use App\Produto;
use App\Status;
use App\Telefone;
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
        $dados = [
            'user' => Auth::user()
        ];

        return view('front.checkout', $dados);
    }

    public function pedido(Request $request)
    {
        $pedido = new Pedido();
        $id_endereco = $request->input('endereco.endereco_id');
        $id_telefone = $request->input('telefone.telefone_id');
        Auth::user()->pedido()->save($pedido);

        if($id_endereco == 0)
        {
            $endereco = Endereco::create($request->json('endereco'));
            $pedido->endereco()->save($endereco);
            Auth::user()->endereco()->save($endereco);
        } else
        {
            $endereco = Auth::user()->endereco()->where('id', $id_endereco)->first();
            $pedido->endereco()->save($endereco);
        }

        if($id_telefone == 0){
            $telefone = Telefone::create($request->json('telefone'));
            $pedido->telefone()->save($telefone);
            Auth::user()->telefone()->save($telefone);
        } else{
            $telefone = Auth::user()->telefone()->where('id', $id_telefone)->first();
            $pedido->telefone()->save($telefone);
        }

        $pedido->item()->createMany($request->json('itens'));

        return $pedido->toJson();
    }

    public function cotacao(Request $request){
        $cotacao = new Cotacao();
        $cotacao->tipo = 'CLIENTE';
        $cotacao->status = Status::PUBLICADA;
        Auth::user()->cotacao()->save($cotacao);
        $cotacao->item()->createMany($request->json('itens'));

        return "sucesso";
    }
    public function ofertas(){
        $dados = [
            'ofertas'=> Oferta::all()
        ];

        return view('front.ofertas', $dados);
    }

    public function layout(){
        $dados = [
            'titulo' => 'Administração',
            'descricao' => 'Essa é a página administrativa'
        ];

        return view('templates.architet.index', $dados);
    }
}
