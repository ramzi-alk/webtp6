<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ChasseWorldRepository;
use App\Repository\EntityRepository;

use App\Entity\Chasse;
use App\Form\ChasseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChasseController extends AbstractController
{
    /**
     * @Route("/chasse", name="app_chasse")
     */
    public function index(ChasseWorldRepository $chasseWorldRepository, EntityRepository $entityRepository, Request $request): Response
    {
        $chasse = new Chasse();
        $user = $this->getUser();
        
        $form = $this->createForm(ChasseType::class, $chasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez les données du formulaire si nécessaire
        }

        return $this->render('chasse/index.html.twig', [
            'chasses_world' => $chasseWorldRepository->findAll(),
            'pokemons' => $entityRepository->findAllByUserId($user->getId()),
            'form' => $form->createView(),
        ]);
    }
}

