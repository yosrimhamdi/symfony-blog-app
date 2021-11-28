<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController {
  /**
   * @Route("/register", name="auth")
   */
  public function register(
    Request $request,
    UserPasswordEncoderInterface $encoder,
    EntityManagerInterface $manager
  ): Response {
    $user = new User();

    $form = $this->createForm(RegisterType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $hash = $encoder->encodePassword($user, $user->getPassword());
      $user->setPassword($hash);

      $manager->persist($user);
      $manager->flush();
    }

    return $this->render('auth/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
