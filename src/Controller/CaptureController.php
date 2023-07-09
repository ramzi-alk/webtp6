<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CaptureDataService;

class CaptureController extends AbstractController
{
    private $captureDataService;

    public function __construct(CaptureDataService $captureDataService)
    {
        $this->captureDataService = $captureDataService;
    }

    #[Route('/capture', name: 'app_capture')]
    public function capture(): Response
    {
        $captureData = $this->captureDataService->getCaptureData();
        $pokemons = $this->captureDataService->loadPokemonData();

        return $this->render('capture/index.html.twig', [
            'controller_name' => 'CaptureController',
            'capture_data' => $captureData,
            'pokemons' => $pokemons,
        ]);
    }
}
