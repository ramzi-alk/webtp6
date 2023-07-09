<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommerceType;
use App\Entity\Commerce;
use App\Repository\CommerceRepository;
use App\Entity\PokemonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class CommerceController extends AbstractController
{
    /**
     * @Route("/commerce", name="Commerce" , methods={"GET"})
     * 
     */
    public function index(CommerceRepository $commerceRepository): Response
    {
       
        return $this->render('commerce/index.html.twig', [
            'market_pokemons' => $commerceRepository->findAll(),

        ]);
    }

    /**
     * @Route("/sell/{id}", name="pokemon_type_sell" , methods={"GET","POST"})
     * 
     */
    public function sellPokemon(Request $request, PokemonType $pokemonType): Response
    {
        // Créer le formulaire avec l'entité Commerce
        $commerce = new Commerce();
        $form = $this->createForm(CommerceType::class, $commerce);
        $form->handleRequest($request);
    
       

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();

         
    
            
            $user = $this->getUser();
    
            $sellPrice = $form->getData()->getSalePrice();

           
            $pokemonType->setEtatVente(true);
    
           
            $commerce->setPokemon($pokemonType);

            $commerce->setSalePrice($sellPrice);
    
            
            $commerce->setDresseur($user);

            $commerce->setAcheteur(null);
    
            
            $entityManager->persist($pokemonType);
            $entityManager->persist($commerce);
            $entityManager->flush();
    
            
            return $this->redirectToRoute('homepage');
        }
    
        return $this->render('commerce/sell.html.twig', [
            'pokemon_type' => $pokemonType,
            'form' => $form->createView(),
        ]);
    }

/**
 * @Route("/buy/{id}", name="confirm_purchase", methods={"GET", "POST"})
 */
public function confirmPurchase(Request $request, Commerce $commerce, CsrfTokenManagerInterface $csrfTokenManager)
{
    $form = $this->createFormBuilder()
        ->add('csrf_token', HiddenType::class, [
            'data' => $csrfTokenManager->getToken('confirm_purchase')->getValue(),
        ])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        print_r("testSubmit");
        $user = $this->getUser();
        $salePrice = $commerce->getSalePrice();
        $newBalance = $user->getPieces() - $salePrice;
        $pokemon = $commerce->getPokemon();

        $pokemon->setEtatVente(false);
        $pokemon->setIdDresseur($user->getId());

        $commerce->setAcheteur($user);

        $user->setPieces($newBalance);

        $entityManager->persist($pokemon);
        $entityManager->persist($user);
        $entityManager->persist($commerce);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    return $this->render('commerce/buy.html.twig', [
        'market_type' => $commerce,
        'form' => $form->createView(),
    ]);
}






//     /**
//      * @Route("buy/{id}", name="commerce_show", methods={"GET, POST"})
//      */
//     public function buyPokemon($id): Response
// {   
//     print_r("test") ;
//     $entityManager = $this->getDoctrine()->getManager();

//     // Récupérer l'objet pokemon à partir de l'ID
//     $commerceType = $entityManager->getRepository(Commerce::class)->find($id);

//     $pokemonType = $commerceType->getPokemon();


//     // Autres traitements liés à l'achat du Pokémon

//     return $this->render('commerce/buy.html.twig', [
//         'pokemon_type' => $pokemonType,
//         'market_type' => $commerceType,
//     ]);
// }
}
