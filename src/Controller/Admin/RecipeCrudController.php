<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title'),
            TextEditorField::new('description'),
            TimeField::new('setup_time'),
            TimeField::new('rest_time'),
            TimeField::new('cooking_time'),
            TextEditorField::new('Steps'),
            ArrayField::new('ingredients'),
            AssociationField::new('allergen_id'),
            AssociationField::new('diet_id'),
        ];
    }

}
