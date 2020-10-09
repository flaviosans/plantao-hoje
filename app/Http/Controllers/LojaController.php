<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ILojaService;
use App\Imagem;
use App\Library\Message;
use App\Loja;
use Auth;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    protected $lojaService;

    public function __construct(ILojaService $lojaService)
    {
        $this->lojaService = $lojaService;
    }
    
    public function index()
    {
        $userId = Auth::user()->id;
        $dados = [
            'lojas'=> $this->lojaService->getAll($userId, 10)
        ];

        return view('admin.lojas.lojas', $dados);
    }

    public function create()
    {
        return view('admin.lojas.form');
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $loja = $this->lojaService->create($userId, $request);

        return redirect()->route('lojas.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $userId = Auth::user()->id;

        $dados  = [
            'loja'=> $this->lojaService->getOne($userId, $id)
        ];

        return view('admin.lojas.form', $dados);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::user()->id;
        
        $this->lojaService->update($userId, $id, $request);

        Message::info('Loja Atualizada com sucesso!');

        return redirect()->route('lojas.index');
    }

    public function destroy($id)
    {
        Message::info('Não é possível apagar uma loja! Entre em Contato com a nossa equipe!');
        return redirect()->route('lojas.index');
    }
}
