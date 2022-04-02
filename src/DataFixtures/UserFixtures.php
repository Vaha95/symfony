<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const PIM = 'Pim';
    const HAN = 'Han';

    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setFirstname('Pim')->setLastname('Pom');
         $manager->persist($user);
         $this->addReference(self::PIM, $user);

         $user = new User();
         $user->setFirstname('Han')->setLastname('Hon');
         $manager->persist($user);
         $this->addReference(self::HAN, $user);

        $manager->flush();
    }
}
