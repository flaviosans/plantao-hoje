<?php

namespace App\Http\Services;

use App\Http\Interfaces\ILojaService;
use App\Loja;
use App\Imagem;

class LojaService implements ILojaService
{
    public function getAll($userId, $paginate)
    {
        return Loja::where('user_id', $userId)->paginate($paginate);
    }

    public function getOne($userId, $lojaId)
    {
        return Loja::findOrFail($lojaId);
    }

    public function create($userId, $request)
    {
        $loja = new Loja();
        $loja->fill($request->all());
        $loja->user_id = $userId;
        $loja->save();

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $loja);
        }

        return $loja;
    }

    public function update($userId, $lojaId, $request)
    {
        $loja = Loja::findOrFail($lojaId);
        $loja->fill($request->all());
        $loja->save();

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $loja);
        }
    }

    public function delete($userId, $lojaId){}
}