<?php


namespace App\Http\Services;


use App\Endereco;
use App\Pedido;
use App\Telefone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PedidoService
{
    public function getAll($paginate = 10)
    {
        return Pedido::orderBy('created_at', 'desc')
            ->paginate($paginate);
    }

    public function findById($id)
    {
        return Pedido::findOrFail($id);
    }


    public function create(Request $request): Pedido
    {
        $pedido = new Pedido();
        $id_endereco = $request->input('endereco.endereco_id');
        $id_telefone = $request->input('telefone.telefone_id');
        Auth::user()->pedido()->save($pedido);

        if ($id_endereco == 0) {
            $endereco = Endereco::create($request->json('endereco'));
            $pedido->endereco()->save($endereco);
            Auth::user()->endereco()->save($endereco);
        } else {
            $endereco = Auth::user()->endereco()->where('id', $id_endereco)->first();
            $pedido->endereco()->save($endereco);
        }

        if ($id_telefone == 0) {
            $telefone = Telefone::create($request->json('telefone'));
            $pedido->telefone()->save($telefone);
            Auth::user()->telefone()->save($telefone);
        } else {
            $telefone = Auth::user()->telefone()->where('id', $id_telefone)->first();
            $pedido->telefone()->save($telefone);
        }
        return $pedido;
    }
}