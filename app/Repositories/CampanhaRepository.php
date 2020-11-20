<?php

namespace App\Repositories;

use App\Campanha;
use App\Library\File;

class CampanhaRepository
{
    public function getCampanhas($paginate = 10)
    {
        return Campanha::where('loja_id', '=', session('loja'))
            ->orderBy('created_at', 'desc')
            ->paginate($paginate);
    }

    public function findCampanha($id)
    {
        return Campanha::find($id);
    }

    public function saveCampanha($request)
    {
        $campanha = new Campanha();
        $campanha->loja_id = session()->get('loja');
        $campanha->fill($request->all());
        $campanha->save();

        return $campanha;
    }

    public function updateCampanha($request, $id)
    {
        $campanha = Campanha::findOrFail($id);
        $campanha->fill($request->all());
        $campanha->save();

        return $campanha;
    }

    public function deleteCampanha($id)
    {
        $campanha = Campanha::findOrFail($id);
        $campanha->delete();
    }
}
