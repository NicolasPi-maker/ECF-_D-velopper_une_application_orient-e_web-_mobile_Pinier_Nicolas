<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PatientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Patient::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      $crud->setPageTitle('new', 'Créer le profil d\'un patient' );
      return $crud->setPageTitle('index', 'Patients' );
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('lastName','Prénom'),
            AssociationField::new('allergen_id','Nombre d\'allergènes'),
            AssociationField::new('diet_id', 'Nombre de régimes'),
            AssociationField::new('patient_user_id', 'Adresse email de l\'utilisateur'),

        ];
    }

}
