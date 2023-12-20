<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface  $hasher;

    public function __construct(UserPasswordHasherInterface $pwd)
    {
        $this->hasher = $pwd;
    }

    
    public function load(ObjectManager $manager): void
    {
       
            $user = new User();
            $user->setPrenom("Martine");
            $user->setNom("Simpson");
            $user->setEmail("martine@test1.fr");

            $user->setRoles(["ROLE_MANAGER"]);
    
            $password= $this->hasher->hashPassword($user,"test123");
            $user->setPassword($password);
    
            $manager->persist($user);
        

        $manager->flush();
    }
}
