<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\{Article, Category, Comment};

class AppFixtures extends Fixture {
  public function load(ObjectManager $manager): void {
    // $product = new Product();
    // $manager->persist($product);

    $manager->flush();
  }
}
