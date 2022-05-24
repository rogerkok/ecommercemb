<?php

namespace App\Controller;

use App\Form\ModifPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use  App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('compte/compte.html.twig', [
            'controller_name' => 'Mon Compte',
        ]);
    }
    #[Route('/compte/password', name: 'app_compte_password')]
    public function password(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
       $notification=null;
        $user = $this->getUser();
        $form = $this->createForm(ModifPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
              if ($passwordHasher->isPasswordValid($user, $old_pwd)) {
            $new_pwd = $form->get('new_password')->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $new_pwd);
            $user->setPassword($hashedPassword);
            $userRepository->add($user, true);
            $notification = "Mot de passe mise à jour avec succès";
        }else{
            $notification = "Mot de passe actuel incorrect";
        }
            

            //return $this->redirectToRoute('app_compte', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('compte/password.html.twig', [
            'controller_name' => 'Modifier mot de passe',
            'form' => $form->createView(),
             'notification' => $notification,
        ]);
    }
}
