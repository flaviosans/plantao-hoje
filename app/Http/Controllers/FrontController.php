<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Cotacao;
use App\Endereco;
use App\Http\Services\PedidoService;
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
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index()
    {
        $dados = array(
            'ofertas' => Oferta::orderBy('created_at', 'desc')->take(6)->get(),
            'marcas' => Marca::all(),
            'bannerTopo' => Banner::where('tipo', 1)->get(),
            'bannerMeio' => Banner::where('tipo', 2)->get()
        );

        return view('front.index', $dados);
    }

    public function busca(Request $request)
    {
        $produto = Produto::
            where('nome', 'like', '%' . $request->q . '%')
            ->pluck('id')->toArray();

        $dados = [
            'ofertas' => Oferta::whereIn('produto_id', $produto)->get()
        ];

        return view('front.ofertas', $dados);
    }

    public function checkout(Request $request)
    {
        $dados = [
            'user' => Auth::user()
        ];

        return view('front.checkout', $dados);
    }

    public function pedido(Request $request)
    {
        $pedido = $this->pedidoService->create($request); //TODO: Implementar salvamento de pedido melhor

        $pedido->item()->createMany($request->json('itens'));

        return $pedido->toJson();
    }

    public function cotacao(Request $request)
    {
        $cotacao = new Cotacao();
        $cotacao->tipo = 'CLIENTE';
        $cotacao->status = Status::PUBLICADA;
        Auth::user()->cotacao()->save($cotacao);
        $itens = [];
        foreach ($request->json('itens') as $cada) {
            $cada['preco_normal'] = 0;
            $cada['preco_promocao'] = 0;
            $itens[] = $cada;
        }
        $cotacao->item()->createMany($itens);

        return "sucesso";
    }

    public function ofertas()
    {
        $dados = [
            'ofertas' => Oferta::all()
        ];

        return view('front.ofertas', $dados);
    }

    public function layout()
    {
        $dados = [
            'titulo' => 'Administração',
            'descricao' => 'Essa é a página administrativa'
        ];

        return view('templates.architet.index', $dados);
    }
}
