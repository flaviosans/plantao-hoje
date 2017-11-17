<?php

namespace App\Http\Controllers;

use App\Imagem;
use App\Library\Message;
use \App\Loja;
use Auth;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = [
            'lojas'=> Loja::where('user_id', '=', Auth::user()->id)->paginate(10)
        ];

        return view('admin.lojas.lojas', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [

        ];

        return view('admin.lojas.form', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loja = new Loja();
        $loja->fill($request->all());
        $loja->user_id = Auth::user()->id;
        $loja->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $loja);
        }

        return redirect()->route('lojas.index');

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
        $dados  = [
            'loja'=> Loja::findOrFail($id)
        ];

        return view('admin.lojas.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loja = Loja::findOrFail($id);
        $loja->fill($request->all());
        $loja->save();

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $loja);
        }

        Message::info('Loja Atualizada com sucesso!');

        return redirect()->route('lojas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::info('Não é possível apagar uma loja! Entre em Contato com a nossa equipe!');
        return redirect()->route('lojas.index');
    }
}
