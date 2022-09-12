<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

  public function configureCrud(Crud $crud): Crud
  {
    $crud->setPageTitle('index', 'Liste des utilisateurs');
    return $crud->setPageTitle('new', 'Créer un utilisateur (n\'oubliez pas de créer le patient associé');
  }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
