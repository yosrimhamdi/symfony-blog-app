<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController {
  /**
   * @Route("/register", name="auth")
   */
  public function register(Request $request): Response {
    $user = new User();

    $form = $this->createForm(RegisterType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      dd($user);
    }

    return $this->render('auth/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
