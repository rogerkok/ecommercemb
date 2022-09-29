<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/commande', name: 'app_order')]
    public function index(Cart $cart, Request $request): Response
    {
        if (!$this->getUser()->getAdresses()->getValues())
        {
            return $this->redirectToRoute('app_adresse_new');

        }
        $form = $this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            dd($form);
        }
        return $this->render('order/index.html.twig', [
            'controller_name' => 'valider ma commande',
            'form'=>$form->createView(),
            'cart'=>$cart->getFull()
        ]);
    }
}
