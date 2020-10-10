<?php 

namespace App\Http\Interfaces;

interface ILojaService
{
    public function getAll($userId, $paginate);

    public function getOne($userId, $lojaId);

    public function create($userId, $loja);

    public function update($userId, $lojaId, $loja);

    public function delete($userId, $lojaId);
}
