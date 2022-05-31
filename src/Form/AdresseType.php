<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomadr', TextType::class, [
                 'label'=>'Nom de l\'adresse',
                 'attr'=>[
                     'placeholder'=>'Nommer l\'adresse',
                 ]
             ])  
       
            ->add('entreprise', TextType::class, [
                 'label'=>'Votre entreprise (facultative)',
                 'attr'=>[
                     'placeholder'=>'Veuillez saisir votre entreprise si elle existe',
                 ]
             ])  
            ->add('adresse', TextType::class, [
                 'label'=>'Votre adresse',
                 'attr'=>[
                     'placeholder'=>'Veillez saisir votre adresse',
                 ]
             ])  
            ->add('bp', TextType::class, [
                 'label'=>'Votre boite postale',
                 'attr'=>[
                     'placeholder'=>'Veillez saisir votre boite postale',
                 ]
             ])  
            ->add('ville', TextType::class, [
                 'label'=>'Votre ville',
                 'attr'=>[
                     'placeholder'=>'Veillez saisir votre ville',
                 ]
             ])  
            ->add('pays', CountryType::class, [
                 'label'=>'Votre pays',
                 'attr'=>[
                      'class'=>'form-control',
                     'placeholder'=>'Veillez saisir votre pays',
                 ]
             ])  
            ->add('phone', TelType::class,[
                 'label'=>'Votre numéro de téléphone',
                 'attr'=>[
                     'placeholder'=>'Veillez saisir votre numéro de téléphone',
                 ]
             ])  
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
