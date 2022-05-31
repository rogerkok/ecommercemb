<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compte/adresse')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('compte/adresse/index.html.twig', [
        
             'controller_name' => 'Mes adresses',
        ]);
    }

    #[Route('/new', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function add(Request $request, AdresseRepository $adresseRepository): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $adresse->setClient($this->getUser());
            $adresseRepository->add($adresse, true);

            return $this->redirectToRoute('app_adresse-index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte/adresse/new.html.twig', [
            'adresse' => $adresse,
             'controller_name' => 'Ajout d\'adresse',
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse): Response
    {
        return $this->render('compte/adresse/show.html.twig', [
            'adresse' => $adresse,
             'controller_name' => 'Afficher adresse',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        
        if(!$adresse || $adresse->getClient()!=$this->getUser()){
            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
      }else{
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->add($adresse, true);

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }


      }
        
        return $this->renderForm('compte/adresse/edit.html.twig', [
            'adresse' => $adresse,
             'controller_name' => 'Modifier adresse',
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
