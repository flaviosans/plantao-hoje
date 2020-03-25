<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Imagem;
use App\Library\Message;
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = [
            'marcas'=> Marca::paginate(10),
        ];

        return view('admin.marcas.marcas', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marcas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        $marca = new Marca();
        $marca->fill($request->all());
        $marca->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $marca);
        }

        Message::info('Marca ' . $marca->nome . ' salva com sucesso!');
        return redirect()->route('marcas.index');
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
            'marca' => Marca::findOrFail($id)
        ];

        return view('admin.marcas.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->fill($request->all());
        $marca->save();

        if(isset($request->image)){
            Imagem::atualizar($request->imagem, $marca);
        }

        Message::info('Marca '. $marca->nome . ' alterada com sucesso!');
        return redirect()->route('marcas.index');
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
        $marca = (new \App\Marca)->findOrFail($id);

        if($marca->produto()->count() == 0){
            $marca->delete();
            Message::info('Marca ' . $marca->nome . ' apagada com sucesso!');
        } else{
            Message::warning('A marca ' . $marca->nome . ' tem produtos! 
            Apague os produtos ou selecione para eles outra marca.');
        }

        return redirect()->route('marcas.index');
    }
}
