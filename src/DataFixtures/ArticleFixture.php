<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $article = new Article();
         $article->setTitle('test');
         $article->setContent('test');
         $article->setStatus(true);

         $manager->persist($article);

        $manager->flush();
    }
}
