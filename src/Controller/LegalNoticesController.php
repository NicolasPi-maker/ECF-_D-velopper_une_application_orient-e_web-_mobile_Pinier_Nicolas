<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticesController extends AbstractController
{
  #[Route(path: '/legal_notices', name: 'legal_notices')]
  public function index()
  {
    return $this->render('legalNotices/legalNotices.html.twig');
  }
}