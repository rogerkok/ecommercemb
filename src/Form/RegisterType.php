<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('nom', TextType::class, [
                 'label'=>'Nom',
                 'attr'=>[
                     'placeholder'=>'Saisissez votre nom'
                 ]
             ])
            ->add('prenom', TextType::class, [
                 'label'=>'Prénoms',
                 'attr'=>[
                     'placeholder'=>'Saisissez votre prénom'
                 ]
             ])
            ->add('email', EmailType::class, [
                 'label'=>'Adresse Mail',
                 'attr'=>[
                     'placeholder'=>'Saisissez votre adresse mail'
                 ]
             ])
             ->add('username', TextType::class, [
                 'label'=>'Nom d\'Utilisateur',
                 'constraints'=>new Length(25,4),
                 'attr'=>[
                     'placeholder'=>'Saisissez votre nom d\'utilisateur'
                 ]
             ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'constraints'=>new Length(32,8),
                'invalid_message'=>'Le mot de passe et la confirmation doivent être conforme',
                'required'=>true,
                
                'first_options'=>[
                    'label'=>'Mot de Passe', 
                    'attr'=>[
                    'placeholder'=>'Saisissez votre mot de passe '
                ]

                ],
                'second_options'=>[
                    'label'=>' Confirmer Mot de Passe', 
                'attr'=>[
                    'placeholder'=>'Confirmer votre mot de passe '
                ]
                ]

                
            ])
             
             ->add('submit', SubmitType::class, [
                'label'=>'S\'inscrire',
               
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
