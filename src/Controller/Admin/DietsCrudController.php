<?php

namespace App\Controller\Admin;

use App\Entity\Diets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DietsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Diets::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      $crud->setPageTitle('new', 'Nouveau régime' );
      return $crud->setPageTitle('index', 'Régimes' );
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du régime'),
        ];
    }

}
