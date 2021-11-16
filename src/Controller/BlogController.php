<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController {
  /**
   * @Route("/blog", name="blog")
   */
  public function index(): Response {
    return $this->render('blog/index.html.twig', [
      'controller_name' => 'BlogController',
    ]);
  }

  /**
   * @Route("/blog/new", name="blog_new")
   */
  public function create(): Response {
    return $this->render('blog/create.html.twig');
  }
}
