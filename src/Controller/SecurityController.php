<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController {
  /**
   * @Route("/register", name="security_register")
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

      return $this->redirectToRoute('security_login');
    }

    return $this->render('security/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/login", name="security_login")
   */
  public function login() {
    return $this->render('security/login.html.twig');
  }

  /**
   * @Route("/logout", name="security_logout")
   */
  public function logout() {
  }
}
