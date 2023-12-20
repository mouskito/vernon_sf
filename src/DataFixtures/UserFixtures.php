<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Faker;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface  $hasher;

    public function __construct(UserPasswordHasherInterface $pwd)
    {
        $this->hasher = $pwd;
    }

    public const USER_REF = "admin_user";
    
    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create("fr_FR");
            for ($i = 0; $i < 10; $i++) {
                $user = new User();
                $user->setPrenom($faker->firstName);
                $user->setNom($faker->lastName);
                $user->setEmail($faker->email);

                // $user->setRoles(["ROLE_MANAGER"]);
        
                $password= $this->hasher->hashPassword($user,"test123");
                $user->setPassword($password);
        
                $manager->persist($user);
            }

        $manager->flush();
        $this->addReference(self::USER_REF, $user);
    }
}
