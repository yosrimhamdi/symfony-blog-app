<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
   * @Route("/blog/{id}/edit", name="blog_edit")
   */
  public function form(
    Article $article = null,
    Request $request,
    EntityManagerInterface $manager
  ): Response {
    if (!$article) {
      $article = new Article();
    }

    $form = $this->createForm(ArticleType::class, $article);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      if (!$article->getId()) {
        $article->setCreatedAt(new \DateTime());
      }

      $manager->persist($article);
      $manager->flush();

      return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
    }

    return $this->render('blog/create.html.twig', [
      'form' => $form->createView(),
      'isEditMode' => $article->getId() !== null,
    ]);
  }

  /**
   * @Route("/blog/{id}", name="blog_show")
   */
  public function show(Article $article) {
    return $this->render('blog/show.html.twig', compact('article'));
  }
}
