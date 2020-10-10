<?php

namespace App\Http\Controllers;

use App\Campanha;
use App\Http\Requests\OfertaRequest;
use App\Library\Message;
use App\Loja;
use App\Oferta;
use App\Produto;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index($id = null)
    {
        if($id == null){
            $dados = array(
                'ofertas'=> Loja::find(session('loja'))->oferta()->paginate(10),
                'titulo'=> 'Cuidado que esse método tá todo zuado, por favor'
            );
        }
        else{
            $campanha = Campanha::find($id);
            $dados = array(
                'ofertas'=> Oferta::where('campanha_id', '=', $id)->orderBy('id', 'desc')->paginate(10),
                'campanha'=> $campanha,
                'titulo'=> $campanha->titulo .' - Ofertas'
            );
    }
        return view('admin.ofertas.ofertas', $dados);
    }

    public function create($id)
    {
        $dados = [
            'campanha'=> Campanha::find($id)
        ];
        return view('admin.ofertas.form', $dados);
    }

    public function store(OfertaRequest $request, $id)
    {
        $oferta = new Oferta;
        $oferta->campanha_id = $id;
        $oferta->fill($request->all());

        if(isset($request->nome)){
            $produto = new Produto(['nome'=>$request->nome]);
            $produto->save();

            $oferta->produto_id = $produto->id;
        }
        $oferta->save();

        Message::info('Oferta Adicionada com sucesso!');

        return redirect()->route('campanhas.ofertas.index', $id);
    }

    public function edit($campanha, $id)
    {
        $dados = array(
            'oferta'=>Oferta::find($id),
            'campanha'=> Campanha::find($campanha)
        );
        return view('admin.ofertas.form', $dados);
    }

    public function update(OfertaRequest $request, $campanha, $id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->fill($request->all());
        $oferta->save();

        return redirect()->route('campanhas.ofertas.index', $campanha);
    }

    public function destroy($campanha, $id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->delete();

        return redirect()->route('campanhas.ofertas.index', $campanha);
    }
}
