<?php

namespace App\Controller\Admin;

use App\Entity\Allergens;
use App\Entity\Diets;
use App\Entity\Difficulty;
use App\Entity\Message;
use App\Entity\Patient;
use App\Entity\Recipe;
use App\Entity\Review;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PatientCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Patient', 'fa-solid fa-business-time');
        yield MenuItem::linkToCrud('Utilisateurs','fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Messages', 'fa-solid fa-envelope', Message::class);
        yield MenuItem::linkToCrud('Recette','fa-solid fa-utensils', Recipe::class);
        yield MenuItem::linkToCrud('Régime','fa-solid fa-carrot', Diets::class);
        yield MenuItem::linkToCrud('Allergènes','fa-solid fa-hand-dots', Allergens::class);
        yield MenuItem::linkToCrud('Avis', 'fa-solid fa-star', Review::class);
    }
}
