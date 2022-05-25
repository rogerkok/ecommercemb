<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            ImageField::new('ilustration')->setBasePath('produits')
            ->setUploadDir('public/produits')
            ->setRequired(false),
            SlugField::new('slug')->setTargetFieldName('nom'),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            MoneyField::new('prix')->setCurrency('XOF')->setNumDecimals(0),
            AssociationField::new('categorie')
        
        ];
    }
    
}
