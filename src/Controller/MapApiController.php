<?php

namespace App\Controller;

use App\Repository\TileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MapApiController extends AbstractController
{
    #[Route('/api/map', name: 'api_map_data')]
    public function getMapData(TileRepository $tileRepository): JsonResponse
    {
        // On récupère les données essentielles pour limiter le poids du JSON
        $tiles = $tileRepository->findAll();
        $data = [];
        
        foreach ($tiles as $tile) {
            $data[] = [
                'q' => $tile->getCoordQ(),
                'r' => $tile->getCoordR(),
                't' => $tile->getType()
            ];
        }

        return new JsonResponse($data);
    }
    #[Route('/api/map/{q}/{r}/{perception}', name: 'api_map_view')]
public function getPlayerView(int $q, int $r, int $perception, TileRepository $repo): JsonResponse
{
    $tiles = $repo->findByViewDistance($q, $r, $perception);
    
    $data = array_map(fn($t) => [
        'q' => $t->getCoordQ(),
        'r' => $t->getCoordR(),
        't' => $t->getType()
    ], $tiles);

    return new JsonResponse($data);
}
}