<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\{Article, Category, Comment};

class AppFixtures extends Fixture {
  public function load(ObjectManager $manager): void {
    $faker = \Faker\Factory::create();

    for ($i = 0; $i < 3; $i++) {
      $category = new Category();
      $category->setTitle($faker->sentence());

      $manager->persist($category);

      for ($j = 0; $j < mt_rand(4, 6); $j++) {
        $article = new Article();
        $description = join(' ', $faker->paragraphs(5));
        $article
          ->setName($faker->sentence())
          ->setImageURL($faker->imageUrl())
          ->setDescription($description)
          ->setCreatedAt($faker->dateTimeBetween('-6 monthds'))
          ->setCategory($category);

        $manager->persist($article);

        for ($k = 0; $k < mt_rand(4, 10); $k++) {
          $comment = new Comment();
          $content = join(' ', $faker->paragraphs(2));
          $days = (new \DateTime())->diff($article->getCreatedAt())->days;
          $comment
            ->setAuthor($faker->name)
            ->setContent($content)
            ->setCreatedAt($faker->dateTimeBetween("- $days days"))
            ->setArticle($article);

          $manager->persist($comment);
        }
      }
    }

    $manager->flush();
  }
}
