<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create("fr_FR");
            for ($i = 0; $i < 10; $i++) {
               $article = new Article();

               $article->setTitre($faker->realText($maxNbChars =20));
               $article->setResume($faker->realText($maxNbChars = 200, $indexSize = 2));
               $article->setContenu($faker->realText($maxNbChars = 400));

               $article->setImage("bart.png");
               $article->setCreatedAt(new \DateTimeImmutable);


               $article->setUser($this->getReference(UserFixtures::USER_REF));
                
                $manager->persist($article);
            }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
