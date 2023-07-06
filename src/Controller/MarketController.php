<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PokemonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MarketController extends AbstractController
{
    /**
     * @Route("/market", name="market")
     * 
     */
    public function index()
    {
       

        return $this->render('market/index.html.twig', [
            'controller_name' => 'MarketController',
        ]);
    }

    /**
     * @Route("buy/{id}", name="market_show", methods={"GET"})
     */
    public function buyPokemon(PokemonType $pokemonType): Response
    {
        return $this->render('market/show.html.twig', [
            'pokemon_type' => $pokemonType,
        ]);
    }
}
