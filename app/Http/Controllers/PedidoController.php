<?php

namespace App\Http\Controllers;

use App\Http\Services\PedidoService;
use App\Pedido;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index()
    {
        $data = [
            'pedidos' => $this->pedidoService->getAll()
        ];

        return view('admin.pedidos.pedidos', $data);
    }

    public function show(Pedido $pedido)
    {
        $data = [
            'pedido' => $pedido,
            'endereco' => $pedido->endereco()->first()
        ];

        return view('admin.pedidos.view', $data);
    }

    public function print(Pedido $pedido){
        $data = [
            'pedido' => $pedido
        ];

        return view('admin.pedidos.print', $data);
    }
}