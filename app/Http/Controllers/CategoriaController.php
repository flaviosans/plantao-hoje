<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\CategoriaRequest;
use App\Imagem;
use App\Library\Message;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = [
            'categorias'=>Categoria::paginate(10)
        ];
        return view('admin.categorias.categorias', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [
            'categorias'=> Categoria::all()
        ];
        return view('admin.categorias.form', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->fill($request->all());
        $categoria->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $categoria);
        }


        Message::info('Categoria ' . $categoria->nome . ' criada com sucesso!');
        return redirect()->route('categorias.index');
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
            'categoria'=>Categoria::findOrFail($id),
            'categorias'=> Categoria::all(),
        ];

        return view('admin.categorias.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->fill($request->all());
        $categoria->save();

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $categoria);
        }

        Message::info('Categoria ' . $categoria->nome . ' alterada com sucesso!');

        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        Message::info('Apagado Com Sucesso!');
        return redirect()->route('categorias.index');
    }

    public function recursiva(){
        Categoria::menu();
    }
}
