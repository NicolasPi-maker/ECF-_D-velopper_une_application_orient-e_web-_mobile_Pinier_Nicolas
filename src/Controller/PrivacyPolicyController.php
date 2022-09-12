<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyPolicyController extends AbstractController
{
  #[Route(path: 'privacy_policy', name: 'privacy_policy')]
  public function index()
  {
    return $this->render('legalNotices/privacyPolicy.html.twig');
  }

}