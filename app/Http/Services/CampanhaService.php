<?php

namespace App\Http\Services;

use App\Campanha;
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
        return $this->campanhaRepository->saveCampanha($request);
    }

    public function updateCampanha($request, $id)
    {
        return $this->campanhaRepository->updateCampanha($request, $id);
    }

    public function deleteCampanha($id)
    {
        return $this->campanhaRepository->deleteCampanha($id);
    }
}