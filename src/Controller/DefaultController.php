<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Recipe;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\PatientRepository;
use App\Repository\RecipeRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  #[Route(path: '/', name: 'home')]
  public function index(): Response
  {
    $recipes = $this->getRecipes();

    $currentUser = null;
    $patientRecipes = [];

    # Check if an user is connected and is not an admin
    if($this->getUser() && $this->getUser()->getRoles() === ['ROLE_USER']) {
      # Check if the current user have a patient profile
      $currentUser = $this->getCurrentPatient();
      if($currentUser !== null) {
        if($this->dietRecipeFilter()) {
          $patientRecipes = $this->dietRecipeFilter();
        }
      }
    }

    return $this->render('home/home.html.twig', [
      'recipes' => $recipes,
      'patient' => $currentUser,
      'patientRecipes' => $patientRecipes,
    ]);
  }

  #[Route(path: '/recipe{slug}', name: 'recipe')]
  public function recipePage(
    string $slug,
    RecipeRepository $recipeRepository,
    Request $request,
    ManagerRegistry $doctrine,
    PatientRepository $patientRepository,
    ReviewRepository $reviewRepository
  )
  {
    $recipe = $recipeRepository->findOneBy(['id' => $slug]);
    $review = new Review();
    $reviews = $reviewRepository->findAllByRecipe($slug);

    $recipeAVG = ($reviewRepository->getRecipeReviewAverage($slug));

    $user = $this->getUser();

    $currentPatient = $patientRepository->findOneBy(['patient_user_id'=> $user]);

    $form = $this->createForm(ReviewType::class, $review);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isSubmitted()) {

      if(isset($_POST['review-btn'])) {
        $review->setNote($_POST['bubble']);
      }
      $entityManager = $doctrine->getManager();
      $review->setPatientId($currentPatient);
      $review->setRecipeId($recipe);
      $review->setPostDate(new \DateTime());
      $entityManager->persist($review);
      $entityManager->flush();

      $reviews = $reviewRepository->findAllByRecipe($slug);
      $recipeAVG = ($reviewRepository->getRecipeReviewAverage($slug));

      unset($review);
      unset($form);
      $review = new Review();
      $form = $this->createForm(ReviewType::class, $review);
    }

      return $this->render('recipe/recipe.html.twig', [
        'recipe' => $recipe,
        'form' => $form->createView(),
        'patient' => $currentPatient,
        'reviews' => $reviews,
        'recipeNote' => round($recipeAVG[1]),
      ]);
  }

  public function getRecipes(): array
  {
    $recipeRepository = $this->em->getRepository(Recipe::class);
    return $recipeRepository->findAll();
  }

  public function getCurrentPatient()
  {
    $patientRepository = $this->em->getRepository(Patient::class);
    return $patientRepository->findOneBy(['patient_user_id'=>$this->getUser()]);
  }

  public function allergenRecipeFilter(): array
  {
    $allergenRecipes = [];

    foreach($this->getRecipes() as $recipe) {
      $currentAllergens = [];
      # add recipe in $allergenRecipes if patient do not have any allergens
      if($this->getCurrentPatient()->getAllergenId()[0] !== null) {
          foreach($recipe->getAllergenId() as $allergen) {
            $currentAllergens[] = $allergen->getName();
          }
          foreach($this->getCurrentPatient()->getAllergenId() as $patientAllergen) {
            # filter recipe depends of patient allergens and recipe allergens
            if(!in_array($patientAllergen->getName(), $currentAllergens) && !in_array($recipe, $allergenRecipes)) {
              $allergenRecipes[] = $recipe;
            } else  {
              # unset recipe if current patient allergen is found in $currentAllergens array
              if((($key = array_search($recipe, $allergenRecipes)) !== false)) {
                unset($allergenRecipes[$key]);
              }
            }
          }
        } else {
        $allergenRecipes[] = $recipe;
      }
    }
    return $allergenRecipes;
  }

  public function dietRecipeFilter()
  {
    $dietRecipes = [];

    $recipesAllergens = $this->allergenRecipeFilter();

    foreach ($recipesAllergens as $recipe) {
      $currentDiets = [];
      foreach ($recipe->getDietId() as $diet) {
        $currentDiets[] = $diet->getName();
      }
      # add recipe in $dietRecipes if patient do not have any diet
      if($this->getCurrentPatient()->getDietID()[0] !== null) {
        foreach ($this->getCurrentPatient()->getDietId() as $patientDiet) {
          # filter recipe depends of patient diets and recipe diets
          if(in_array($patientDiet->getName(), $currentDiets) && !in_array($recipe, $dietRecipes)) {
            $dietRecipes[] = $recipe;
          }
        }
      } else {
        $dietRecipes = $recipesAllergens;
      }
    }
    return $dietRecipes;
  }
}