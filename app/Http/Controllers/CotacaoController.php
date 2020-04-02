<?php

namespace App\Http\Controllers;

use App\Cotacao;
use App\Http\Requests\CampanhaRequest;
use App\Imagem;
use App\Library\File;
use App\Library\Message;
use App\Item;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotacaoController extends Controller
{

    public function respostas($id){
        if(!Cotacao::find($id)->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }
        $dados = array(
            'cotacoes' => Cotacao::resposta($id)->paginate(10),
            'titulo' => 'respostas de cotação recebidas'
        );

        return view('admin.cotacoes.cotacoes', $dados);
    }

    public function enviadas(){
        $dados = array(
            'cotacoes' => Cotacao::todas()->paginate(10),
            'titulo' => 'Cotações enviadas'
        );

        return view('admin.cotacoes.cotacoes', $dados);
    }

    public function recebidas()
    {
        $dados = array(
            'cotacoes' => Cotacao::recebidas()->paginate(10),
            'titulo' => 'Cotações de clientes'
        );

        return view('admin.cotacoes.cotacoes', $dados);
    }

    public function publicadas(){
        $dados = array(
            'cotacoes' => Cotacao::publicadas()->paginate(10),
            'titulo' => 'Cotações publicadas por clientes'
        );

        return view('admin.cotacoes.cotacoes', $dados);
    }

    public function responder($id){

        $cotacao_parent = Cotacao::findOrFail($id);
        if($cotacao_parent->e_propria()){
            Message::warning('Cotacao é sua!');
            return redirect()->back();
        }

        $cotacao = new Cotacao([
            'cotacao_id' => $id,
            'titulo' => 'Resposta de ' . Auth::user()->name,
            'descricao' => 'Orçamento de empresa',
            'tipo' => 'fornecedor',
            'status' => 'rascunho',
            'user_id' => Auth::user()->id
        ]);

         $cotacao->user_id = Auth::user()->id;

         $cotacao->cotacao_id = $cotacao_parent->id;
         $cotacao->save();

        foreach($cotacao_parent->item as $cada){
            $item = new Item([
                'produto_id'=> $cada->produto_id,
                'quantidade'=> $cada->quantidade
            ]);
            //$item->user_id = $cotacao->user_id;
            $cotacao->item()->save($item);
//            $item->save();
        }
        $dados = [
            'cotacao' => $cotacao,
            'itens' => $cotacao->item()->paginate(10),
        ];
        return view('admin.itens.itens', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $cotacao = new Cotacao([
            'titulo' => 'Orçamento - ' . Auth::user()->name,
            'descricao' => 'Orçamento de cliente',
            'tipo' => 'cliente'
        ]);

        $cotacao->user_id = Auth::user()->id;
        $cotacao->save();



        $dados = [
            'titulo' => $cotacao->titulo,
            'cotacao' => $cotacao,
            'itens' => $cotacao->item()->paginate(10),
        ];

        return view('admin.itens.itens', $dados);
    }

    public function publicar($id){

        if(!Cotacao::find($id)->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }

        $cotacao = Cotacao::findOrFail($id);
        $cotacao->status = Status::PUBLICADA;
        $cotacao->save();

        Message::info('Cotação publicada com sucesso!');

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampanhaRequest $request)
    {
        $cotacao = new Cotacao();
        $cotacao->user_id = Auth::user()->id;
        $cotacao->fill($request->all());
        $cotacao->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $cotacao);
        }

        Message::info('Gravado Com Sucesso!');

        return redirect()->route('cotacoes.itens.index', $cotacao->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $cotacao = Cotacao::find($id);

        if(!$cotacao->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }
        $dados = array(
            'cotacao' => $cotacao
        );

        return view ('admin.cotacoes.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampanhaRequest $request, $id)
    {
        $cotacao = Cotacao::findOrFail($id);

        if(!$cotacao->e_propria()){
            Message::warning('Cotacao não é sua!');
            return redirect()->back();
        }

        $cotacao->fill($request->all());
        $cotacao->save();

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $cotacao);
        }

        return redirect()->route('cotacoes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cotacao = Cotacao::findOrFail($id);

        if(!$cotacao->e_propria()){
            Message::warning('Cotação não é sua!');
            return redirect()->back();
        }

        File::delete($cotacao->banner);
        $cotacao->delete();

        Message::info('Apagado Com Sucesso');
        return redirect()->back();
    }
}
