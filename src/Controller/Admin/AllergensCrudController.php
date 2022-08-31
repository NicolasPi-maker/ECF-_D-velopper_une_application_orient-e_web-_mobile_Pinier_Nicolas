<?php

namespace App\Controller\Admin;

use App\Entity\Allergens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AllergensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergens::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Produit'),
        ];
    }
}
