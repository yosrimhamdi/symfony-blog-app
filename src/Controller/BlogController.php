<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
  public function create(
    Request $request,
    EntityManagerInterface $manager
  ): Response {
    if ($request->request->count() > 0) {
      $article = new Article();
      $article
        ->setName($request->request->get('name'))
        ->setDescription($request->request->get('description'))
        ->setImageURL($request->request->get('imageURL'))
        ->setCreatedAt(new \DateTime());

      $manager->persist($article);
      $manager->flush();
    }

    return $this->render('blog/create.html.twig');
  }
}
