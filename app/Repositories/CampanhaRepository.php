<?php

namespace App\Repositories;

use App\Campanha;

class CampanhaRepository
{
    public function getCampanhas($paginate = 10)
    {
        return Campanha::where('loja_id', '=', session('loja'))
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    }

    public function findCampanha($id)
    {
        return Campanha::find($id);
    }

    public function saveCampanha(Campanha $campanha)
    {
    }

    public function updateCampanha($request, $id)
    {
    }

    public function deleteCampanha($id)
    {
    }
}
