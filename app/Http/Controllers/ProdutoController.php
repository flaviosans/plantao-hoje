<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Imagem;
use App\Library\File;
use App\Library\Message;
use App\Library\Scrapper;
use App\Marca;
use App\Produto;
use App\Token;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = array(
            'produtos'=> Produto::orderBy('created_at', 'desc')->paginate(10),

            'titulo'=>'Cadastro de Produtos'
        );

        return view('admin.produtos.produtos', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [
            'categorias'=> Categoria::all(),
            'marcas'=> Marca::all()
        ];
        return view('admin.produtos.form', $dados);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        if(preg_match("/[0-9]{13}/",$request->nome)){
            $produto = Scrapper::scrap($request->nome);
        }
        else {
            $produto = new Produto();
            $produto->fill($request->all());
            isset($request->proprio) ? $produto->loja_id = $request->proprio : '';
            $produto->save();
            Message::info("Produto Salvo Com Sucesso!");
        }

        isset($request->imagem) ? $produto->salvarImagem($request->imagem) : '';
        isset($request->categorias) ? $produto->salvarCategorias($request->categorias) : '';
        isset($request->tags) ? $produto->criarTags($request->tag) : '';



        return redirect()->route('produtos.index');
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
    public function edit($id)
    {
        $dados = [
            'produto'=>$produto = Produto::find($id),
            'categorias'=> Categoria::all(),
            'marcas'=> Marca::all()
        ];

        return view('admin.produtos.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->fill($request->all());

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $produto);
        }

        if(isset($request->categorias)){
            $produto->categoria()->sync($request->categorias);
        }

        if(isset($request->tags)){
            $produto->atualizarTags($request->tags);
        }

        $tokens = str_replace([' ,', ', ', ' , ', ' '],',', $request->nome);
        $tokens = explode(',', $tokens);

        $idNovosTokens = array();
        foreach($tokens as $token){
            array_push($idNovosTokens, Token::firstOrCreate(['token'=> $token])->id);
        }

        $produto->token()->sync($idNovosTokens);

        $produto->save();

        return redirect()->route('produtos.index');
    }

    public function importar(){
        return view('admin.produtos.importar');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        $produto->delete();

        return redirect()->route('produtos.index');
    }
}
