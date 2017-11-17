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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $dados = [
            'campanha'=> Campanha::find($id)
        ];
        return view('admin.ofertas.form', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function edit($campanha, $id)
    {
        $dados = array(
            'oferta'=>Oferta::find($id),
            'campanha'=> Campanha::find($campanha)
        );
        return view('admin.ofertas.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfertaRequest $request, $campanha, $id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->fill($request->all());
        $oferta->save();

        return redirect()->route('campanhas.ofertas.index', $campanha);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  $campanha
     * @return \Illuminate\Http\Response
     */
    public function destroy($campanha, $id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->delete();

        return redirect()->route('campanhas.ofertas.index', $campanha);
    }
}
