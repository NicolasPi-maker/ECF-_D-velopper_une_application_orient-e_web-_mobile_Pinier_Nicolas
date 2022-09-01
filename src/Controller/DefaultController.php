<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\PatientRepository;
use App\Repository\RecipeRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
  #[Route(path: '/', name: 'home')]
  public function index(RecipeRepository $recipeRepository): Response
  {
    $recipes = $recipeRepository->findAll();

    return $this->render('home/home.html.twig', [
      'recipes' => $recipes,
    ]);
  }

  #[Route(path: '/recipe{slug}', name: 'recipe', methods: "GET")]
  public function recipePage(
    string $slug,
    RecipeRepository $recipeRepository,
    Request $request,
    ManagerRegistry $doctrine,
    UserRepository $userRepository,
    PatientRepository $patientRepository
  )
  {
    $recipe = $recipeRepository->findOneBy(['id' => $slug]);
    $review = new Review();

    $user = $this->getUser();

    $currentPatient = $patientRepository->findOneBy(['patient_user_id'=> $user]);

    $form = $this->createForm(ReviewType::class, $review);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isSubmitted()) {
      $entityManager = $doctrine->getManager();
      $review->setPatientId($currentPatient);
      $entityManager->persist($review);
      $entityManager->flush();
    }

      return $this->render('recipe/recipe.html.twig', [
        'recipe' => $recipe,
        'form' => $form->createView(),
      ]);
  }
}