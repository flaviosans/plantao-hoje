<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $pedido_service;

    public function __construct(PedidoService $pedido_service)
    {
        $this->pedido_service = $pedido_service;
    }
    public function index()
    {
        $dados = [
            'pedidos' => $this->pedido_service->get_all()
        ];

        return view('admin.pedidos.pedidos', $dados);
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