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

    public function show($id)
    {
        $pedido = $this->pedidoService->findById($id);
        $data = [
            'pedido' => $pedido,
            'endereco' => $pedido->endereco()->first()
        ];

        return view('admin.pedidos.view', $data);
    }

    public function print($id){
        $data = [
            'pedido' => $this->pedidoService->findById($id)
        ];

        return view('admin.pedidos.print', $data);
    }
}