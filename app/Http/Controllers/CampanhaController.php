<?php

namespace App\Http\Controllers;

use App\Campanha;
use App\Http\Requests\CampanhaRequest;
use App\Imagem;
use App\Library\File;
use App\Library\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampanhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = array(
            'campanhas'=> Campanha::where('loja_id','=', session('loja'))->orderBy('created_at', 'desc')->paginate(3),
            'titulo'=>'Campanhas'
        );
        return view('admin.campanhas.campanhas', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campanhas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampanhaRequest $request)
    {
        $campanha = new Campanha();
        $campanha->loja_id = session()->get('loja');
        $campanha->fill($request->all());
        $campanha->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $campanha);
        }

        Message::info('Gravado Com Sucesso!');

        return redirect()->route('campanhas.ofertas.index', $campanha->id);
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
        $dados = array(
            'campanha' => Campanha::find($id)
        );

        return view ('admin.campanhas.form', $dados);
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
        $campanha = Campanha::findOrFail($id);
        $campanha->fill($request->all());
        $campanha->save();

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $campanha);
        }

        return redirect()->route('campanhas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campanha = Campanha::findOrFail($id);
        File::delete($campanha->banner);
        $campanha->delete();

        Message::info('Apagado Com Sucesso');
        return redirect()->route('campanhas.index');
    }
}
