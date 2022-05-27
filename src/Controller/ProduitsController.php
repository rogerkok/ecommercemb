<?php

namespace App\Controller;

use App\Classe\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProduitRepository;
use  App\Entity\Produit;
use App\Form\SearchType;

class ProduitsController extends AbstractController
{
    #[Route('/nos-produits', name: 'app_produits')]
    public function index(Request $request ,ProduitRepository $produitRepository): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
             $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produits = $produitRepository->findwithSearch($search);
        }
        else{
            $produits = $produitRepository->findAll();
        }
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'controller_name' => 'Nos produits',
            'form' => $form->createView(),
        ]);
    }
     #[Route('/product/{slug}', name: 'app_produit_voir', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produits/voir.html.twig', [
            'produit' => $produit,
            'controller_name' => $produit->getNom(),
        ]);
    }

}
