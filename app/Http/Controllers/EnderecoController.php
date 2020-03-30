<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Http\Requests\CampanhaRequest;
use App\Imagem;
use App\Library\File;
use App\Library\Message;
use App\Item;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{


    public function index()
    {
        $dados = [
            'enderecos' => Auth::user()->endereco
        ];

        return view('admin.enderecos.enderecos', $dados);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.enderecos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->fill($request->all());
        Auth::user()->endereco()->save($endereco);

        Message::info('Gravado Com Sucesso!');

        return redirect()->route('enderecos.index');
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
            'endereco' => Endereco::find($id)
        ];

        return view ('admin.enderecos.form', $dados);
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
        $endereco = Endereco::findOrFail($id);
        if($endereco->enderecavel->id != Auth::user()->id){
            Message::Warning('Endereço não é seu!');
            return redirect()->back();
        }

        $endereco->fill($request->all());
        $endereco->save();

        return redirect()->route('enderecos.index');
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
