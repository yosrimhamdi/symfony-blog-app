<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController {
  /**
   * @Route("/blog", name="blog")
   */
  public function index(ArticleRepository $repo): Response {
    $articles = $repo->findAll();

    return $this->render('blog/index.html.twig', compact('articles'));
  }

  /**
   * @Route("/blog/new", name="blog_new")
   */
  public function create(): Response {
    $article = new Article();

    $form = $this->createFormBuilder($article)
      ->add('name', TextType::class, [
        'attr' => ['placeholder' => 'description'],
      ])
      ->add('description')
      ->add('imageURL')
      ->getForm();

    return $this->render('blog/create.html.twig', [
      'formArticle' => $form->createView(),
    ]);
  }

  /**
   * @Route("/blog/{id}", name="blog_show")
   */
  public function show(Article $article) {
    return $this->render('blog/show.html.twig', compact('article'));
  }
}
