<?php

namespace App\Controller;

use App\Classe\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_panier')]
    public function index(Cart $cart): Response
    {
      
       

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'Mon panier',
            'cart' => $cart->getFull(),
        ]);
    }
    #[Route('/panier/add/{id}', name: 'app_panier_add')]
    public function add(Cart $cart, int $id): Response
    {
        $cart->add($id); 
      
        return $this->redirectToRoute('app_panier');
    }
    #[Route('/panier/remove', name: 'app_panier_remove')]
    public function remove(Cart $cart): Response
    {
        $cart->remove(); 
        return $this->redirectToRoute('app_produits');
    }
    #[Route('/panier/delete/{id}', name: 'app_panier_delete')]
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id); 
        return $this->redirectToRoute('app_panier');
    }
    #[Route('/panier/decrease/{id}', name: 'app_panier_decrease')]
    public function decrease(Cart $cart, $id): Response
    {
        $cart->decrease($id); 
        return $this->redirectToRoute('app_panier');
    }
}
