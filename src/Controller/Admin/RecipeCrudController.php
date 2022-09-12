<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      $crud->setPageTitle('new', 'Créer une recette' );
      return $crud->setPageTitle('index', 'Recettes' );
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title', 'Nom de la recette'),
            TextEditorField::new('description'),
            AssociationField::new('difficulty_id', 'difficulté'),
            TimeField::new('setup_time', 'Temps de préparation'),
            TimeField::new('rest_time', 'Temps de repos'),
            TimeField::new('cooking_time', 'Temps de cuisson'),
            ArrayField::new('Steps', 'Etapes'),
            ArrayField::new('ingredients'),
            AssociationField::new('allergen_id', 'Nombre d\'allergènes'),
            AssociationField::new('diet_id', 'Nombre de régime compatible'),
            BooleanField::new('is_public', 'Réservée aux patients/Recette publique'),
            ImageField::new('photo')
              ->setBasePath('uploads/recipe_image')
              ->setUploadDir('public/uploads/recipe_image'),

        ];
    }

}
