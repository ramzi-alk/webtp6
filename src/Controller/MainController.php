<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntityRepository;

class MainController extends AbstractController
{
    private $userId;
    /**
     * @Route("/main", name="homepage")
     */
    public function index(EntityRepository $entityRepository)
    {
        $this->userId = $this->getUser()->getId();

        $pokemons = $entityRepository->findAllByUserId($this->userId);
        $nb = sizeof($pokemons);
        $nbEvo = $entityRepository->getNbEvo($this->userId);
        $stats = $entityRepository->getStatsByType($this->userId);
        
        return $this->render('main/index.html.twig', [
            'pokemons' => $pokemons,
            'nb' => $nb,
            'stats' => $stats,
            'nbEvo' => $nbEvo

        ]);
    }
}
