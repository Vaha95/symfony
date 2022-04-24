<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture
{
    public const ABYSSINIAN = 'Abyssinian';
    public const BENGAL = 'Bengal';
    public const CHARTREUX = 'Chartreux';

    private function createBreed(ObjectManager $manager, string $breedName): void
    {
        /* todo Создать фабрику и вынести данный метод туда */
        $breed = new Breed();

        $breed->setName($breedName);

        $manager->persist($breed);
        $this->addReference($breedName, $breed);
    }

    public function load(ObjectManager $manager): void
    {
        // Заведение в БД парод кошек
        $this->createBreed($manager, self::ABYSSINIAN);
        $this->createBreed($manager, self::BENGAL);
        $this->createBreed($manager, self::CHARTREUX);

        $manager->flush();
    }
}
