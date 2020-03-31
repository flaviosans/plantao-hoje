<?php

namespace App\Http\Controllers;

use App\Cotacao;
use App\Http\Requests\OfertaRequest;
use App\Library\Message;
use App\Loja;
use App\Item;
use App\Produto;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {

        if($id == null){
            $dados = array(
                'itens'=> Loja::find(session('loja'))->item()->paginate(10),
                'titulo'=> 'Cuidado que esse método tá todo zuado, por favor'
            );
        }
        else{
            $cotacao = Cotacao::find($id);
            $dados = array(
                'itens'=> $cotacao->item()->paginate(10),
                'cotacao'=> $cotacao,
                'titulo'=> $cotacao->titulo .' - Itens'
            );
    }
        return view('admin.itens.itens', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dados = [
            'cotacao'=> Cotacao::find($id)
        ];
        return view('admin.itens.form', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = new Item;
        $item->user_id = Auth::user()->id;
        $item->fill($request->all());

/*        if(isset($request->nome)){
            $produto = new Produto(['nome'=>$request->nome]);
            $produto->save();

            $item->produto_id = $produto->id;
        }*/
        $cotacao = Cotacao::find($id);
        $cotacao->item()->save($item);

        Message::info('Item Adicionado com sucesso!');

        return redirect()->route('cotacoes.itens.index', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cotacao_id, $id)
    {
        $item = Item::find($id);
        $cotacao = Cotacao::find($cotacao_id);
        if(!$cotacao->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }
        $dados = array(
            'item'=> $item,
            'cotacao'=> $cotacao
        );
        return view('admin.itens.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfertaRequest $request, $cotacao_id, $id)
    {
        $cotacao = Cotacao::find($cotacao_id);
        if(!$cotacao->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }
        $item = Item::findOrFail($id);
        $item->fill($request->all());
        $item->save();

        return redirect()->route('cotacoes.itens.index', $cotacao_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param  $cotacao
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($cotacao, $id)
    {
        if(!Cotacao::find($cotacao)->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('cotacoes.itens.index', $cotacao);
    }
}
