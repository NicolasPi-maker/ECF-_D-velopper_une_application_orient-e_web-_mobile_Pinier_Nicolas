<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
  #[Route(path: '/contact', name: 'contact')]
  public function index(Request $request, ManagerRegistry $doctrine)
  {

    $message = new Message();
    $form = $this->createForm(MessageType::class, $message);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();
      $entityManager->persist($message);
      $entityManager->flush();
    }

    return $this->render('message/message.html.twig', [
      'form' => $form->createView(),
    ]);
  }

}