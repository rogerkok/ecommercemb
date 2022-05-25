<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;

class ProduitsController extends AbstractController
{
    #[Route('/nos-produits', name: 'app_produits')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produits/index.html.twig', [
            'produits' => $produitRepository->findAll(),
            'controller_name' => 'Nos produits',
        ]);
    }
}
