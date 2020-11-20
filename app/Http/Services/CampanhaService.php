<?php

namespace App\Http\Services;

use App\Imagem;
use App\Campanha;
use App\Library\File;
use App\Repositories\CampanhaRepository;

class CampanhaService
{
    private $campanhaRepository;

    public function __construct(
        CampanhaRepository $campanhaRepository
    )
    {
        $this->campanhaRepository = $campanhaRepository;
    }

    public function getCampanhas($paginate = 10)
    {
        return $this->campanhaRepository->getCampanhas($paginate);
    }

    public function findCampanha($id)
    {
        return $this->campanhaRepository->findCampanha($id);
    }

    public function saveCampanha($request)
    {
        $campanha = $this->campanhaRepository->saveCampanha($request);

        if(isset($request->imagem)){
            Imagem::salvar($request->imagem, $campanha);
        }
        
        return $campanha;
    }

    public function updateCampanha($request, $id)
    {
        $campanha = $this->campanhaRepository->updateCampanha($request, $id);

        if(isset($request->imagem)){
            Imagem::atualizar($request->imagem, $campanha);
        }

        return $campanha;
    }

    public function deleteCampanha($id)
    {
        File::delete($campanha->banner);
        $campanha = $this->campanhaRepository->deleteCampanha($id);

        return $campanha;
    }
}