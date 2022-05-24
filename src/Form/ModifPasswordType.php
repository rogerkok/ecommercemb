<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class ModifPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
              'label'=>'Adresse email',
            'disabled'=>true,
            
        ])
        ->add('username', TextType::class, [
            'disabled'=>true,
              'label'=>'Nom d\'Utilisateur',
        ])
         ->add('old_password', PasswordType::class, [
            'mapped'=>false,
           'constraints'=>new Length(32,8),
            'label'=>'Mot de passe actuel','attr'=>[ 
            'placeholder'=>'Saisissez votre mot de passe avtuel',
            ],
             'required'=>true,])
             ->add('new_password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'mapped'=>false,
                'constraints'=>new Length(32,8),
                'invalid_message'=>'Le mot de passe et la confirmation doivent être conforme',
                'required'=>true,
                
                'first_options'=>[
                    'label'=>'Nouveau mot de passe', 
                    'attr'=>[
                    'placeholder'=>'Saisissez votre nouveau mot de passe '
                ]

                ],
                'second_options'=>[
                    'label'=>' Confirmer nouveau mot de passe', 
                'attr'=>[
                    'placeholder'=>'Confirmer votre nouveau mot de passe '
                ]
                ]

                
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Mettre à jour',
               
            ])
                  ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
