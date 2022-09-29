<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Form\OrderType;
use DateTime;
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
     
        return $this->render('order/index.html.twig', [
            'controller_name' => 'valider ma commande',
            'form'=>$form->createView(),
            'cart'=>$cart->getFull()
        ]);
    }
    #[Route('/commande/recap', name: 'app_order_recap')]
    public function add(Cart $cart, Request $request): Response
    {
       
        $form = $this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $carriers = $form->get('carriers')->getData();
            dd($carriers);
            //enregistrer commande
            $order = new Order();
            $order->setClient($this->getUser());
            $order->setCreatedAt(new DateTime());
            $order->setCarrierName($carriers->getNom());
            $order->setCarrierprice($carriers->getTarifs());
            //enregistrer produits
        }
        return $this->render('order/add.html.twig', [
            'controller_name' => 'valider ma commande',
           
            'cart'=>$cart->getFull()
        ]);
    }
}
