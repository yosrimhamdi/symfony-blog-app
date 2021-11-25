<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType {
  public function buildForm(
    FormBuilderInterface $builder,
    array $options
  ): void {
    $builder
      ->add('name')
      ->add('imageURL')
      ->add('description')
      ->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'title',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void {
    $resolver->setDefaults([
      'data_class' => Article::class,
    ]);
  }
}
