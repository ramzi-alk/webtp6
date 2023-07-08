<?php

namespace App\Controller;

use App\Entity\PokemonType;
use App\Form\PokemonTypeType;
use App\Entity\Commerce;
use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

/**
 * @Route("/pokemons")
 */
class PokemonTypeController extends AbstractController
{
    private int $userId;
    /**
     * @Route("/", name="pokemon_type_index", methods={"GET"})
     */
    public function index(EntityRepository $entityRepository): Response
    {
        $this->userId = $this->getUser()->getId();
        return $this->render('pokemon_type/index.html.twig', [
            'pokemon_types' => $entityRepository->findAllByUserId($this->userId),
        ]);
    }

    /**
     * @Route("/new", name="pokemon_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pokemonType = new PokemonType();
        $form = $this->createForm(PokemonTypeType::class, $pokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pokemonType);
            $entityManager->flush();

            return $this->redirectToRoute('pokemon_type_index');
        }

        return $this->render('pokemon_type/new.html.twig', [
            'pokemon_type' => $pokemonType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pokemon_type_show", methods={"GET"})
     */
    public function show(PokemonType $pokemonType): Response
    {
        return $this->render('pokemon_type/show.html.twig', [
            'pokemon_type' => $pokemonType,
        ]);
    }

   

    /**
     * @Route("/{id}", name="pokemon_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PokemonType $pokemonType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemonType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pokemonType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pokemon_type_index');
    }

   

     /**
     * @Route("/{id}/edit", name="pokemon_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PokemonType $pokemonType): Response
    {
        $form = $this->createForm(PokemonTypeType::class, $pokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pokemon_type_index');
        }

        return $this->render('pokemon_type/edit.html.twig', [
            'pokemon_type' => $pokemonType,
            'form' => $form->createView(),
        ]);
    }

    

    
    
    
    


    public function training(PokemonType $pokemonType): Response
    {
        $randomXP = mt_rand(10, 30);
    
        // Vérifier si le dernier entraînement a eu lieu il y a plus d'une heure
        $lastTrainingTime = $pokemonType->getLastTraining();
        $currentTime = new DateTime();
        $interval = $currentTime->diff($lastTrainingTime);
        if ($interval->h < 1) {
        // Si le dernier entraînement est trop récent, retourner une réponse d'erreur
            return $this->redirectToRoute('pokemon_type_show', ['id' => $pokemonType->getId()]);
        }


        if ($pokemonType->getTypeCourbeNiveau() === 'R') {
            $niveau = $pokemonType->getNiveau();
            $xp = $pokemonType->getXp();
    
            $threshold = 0.8 * pow($niveau, 3);
    
            if ($xp >= $threshold) {
                $pokemonType->setNiveau($niveau + 1);
                $pokemonType->setXp($xp - $threshold);
            }
        } elseif ($pokemonType->getTypeCourbeNiveau() === 'M') {
            $niveau = $pokemonType->getNiveau();
            $xp = $pokemonType->getXp();
    
            $threshold = pow($niveau, 3);
    
            if ($xp >= $threshold) {
                $pokemonType->setNiveau($niveau + 1);
                $pokemonType->setXp($xp - $threshold);
            }
        }
        elseif ($pokemonType->getTypeCourbeNiveau() === 'P') {
            $niveau = $pokemonType->getNiveau();
            $xp = $pokemonType->getXp();
    
            $threshold = 1.2 * pow($niveau, 3) - 15 * pow($niveau, 2) + 100 * $niveau - 140;
    
            if ($xp >= $threshold) {
                $pokemonType->setNiveau($niveau + 1);
                $pokemonType->setXp($xp - $threshold);
            }
        }
        elseif ($pokemonType->getTypeCourbeNiveau() === 'L') {
            $niveau = $pokemonType->getNiveau();
            $xp = $pokemonType->getXp();
    
            $threshold = 1.25 * pow($niveau, 3);
    
            if ($xp >= $threshold) {
                $pokemonType->setNiveau($niveau + 1);
                $pokemonType->setXp($xp - $threshold);
            }
        }

        $pokemonType->setXp($pokemonType->getXp() + $randomXP);
        $pokemonType->setLastTraining($currentTime);
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
    
        return $this->redirectToRoute('pokemon_type_show', ['id' => $pokemonType->getId()]);
    }

}
