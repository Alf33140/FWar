<?php

namespace App\Controller;

use App\Repository\TileRepository;
use App\Service\MapGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route('/map/generate', name: 'app_map_generate')]
    public function generate(MapGenerator $generator): Response
    {
        $generator->generateRectangularMap(10, 10); // Crée une grille 10x10
        return $this->redirectToRoute('app_map_display');
    }

    #[Route('/map', name: 'app_map_display')]
    public function index(TileRepository $tileRepository): Response
    {
        return $this->render('map/index.html.twig', [
            'tiles' => $tileRepository->findAll(),
        ]);
    }
}