<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PatientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Patient::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('lastName'),
            AssociationField::new('allergen_id'),
            AssociationField::new('diet_id')

        ];
    }

}
