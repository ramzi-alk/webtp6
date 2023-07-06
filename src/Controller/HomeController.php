<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage'); // Redirection vers la page d'accueil si l'utilisateur est connecté
        }

        return $this->redirectToRoute('app_login'); // Redirection vers la page de connexion par défaut si l'utilisateur n'est pas connecté
    }

    /**
     * @Route("/home", name="app_home")
     * @IsGranted("ROLE_DRESSEUR")
     */
    public function home(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
