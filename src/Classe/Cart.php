<?php

namespace App\Classe;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ProduitRepository;


class Cart{
  private $requestStack;
  private $produitRepository;

    public function __construct(RequestStack $requestStack, ProduitRepository $produitRepository)
    {
        $this->requestStack = $requestStack;
        $this->produitRepository = $produitRepository;

    }
    public function add(int $id){
        
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id]=1;
        }
        $session->set('cart', $cart);
    }
     public function get(){
        $session = $this->requestStack->getSession();
        return $session->get('cart');
    }
      public function remove(){
        $session = $this->requestStack->getSession();
        $session->remove('cart');
    }
    public function delete($id){

        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);
        unset($cart[$id]);
        return $session->set('cart', $cart);

    }
      public function decrease(int $id){
        
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);
        if($cart[$id]>1){
            $cart[$id]--;
        }else{
             unset($cart[$id]);
        }
        $session->set('cart', $cart);
    }
    public function getFull(){
        
         $cartcomplete = [];
        if ($this->get())
    {
        foreach($this->get() as $id=>$quantite){
            $produits = $this->produitRepository->find($id);
            if(!$produits){
                $this->delete($id);
                continue;
            }
                 $cartcomplete[] = [
                'produit'=> $produits,
                'quantite'=>$quantite
            ];

            }
          
            } 
            return $cartcomplete;
    }

}
