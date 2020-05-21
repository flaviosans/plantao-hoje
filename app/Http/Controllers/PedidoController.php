<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $dados = [
            'pedidos' => Pedido::orderBy('created_at', 'desc')->paginate(10)
        ];

        return view('admin.pedidos.pedidos', $dados);
    }

    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->fill($request->all());
    }

    public function show(Pedido $pedido)
    {
        $dados = [
            'pedido' => $pedido,
            'endereco' => $pedido->endereco()->first()
        ];

        return view('admin.pedidos.view', $dados);
    }

    public function print(Pedido $pedido){
        $dados = [
            'pedido' => $pedido
        ];

        return view('admin.pedidos.print', $dados);
    }
}
