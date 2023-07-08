<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChasseController extends AbstractController
{
    /**
     * @Route("/chasse", name="app_chasse")
     */
    public function index(): Response
    {
        return $this->render('chasse/index.html.twig', [
            'controller_name' => 'ChasseController',
        ]);
    }
}
