<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CatFixtures extends Fixture implements DependentFixtureInterface
{
    private function createCat(ObjectManager $manager, string $catName, string $dateBias, ?Breed $breed): void
    {
        /* todo Создать фабрику и вынести данный метод туда */
        $cat = new Cat();

        $cat
            ->setName($catName)
            ->setBorned(new \DateTime($dateBias))
            ->setBreed($breed);

        $manager->persist($cat);
    }

    public function load(ObjectManager $manager): void
    {
        /** @var Breed $abyssinian */
        $abyssinian = $this->getReference(BreedFixtures::ABYSSINIAN);
        /** @var Breed $bengal */
        $bengal = $this->getReference(BreedFixtures::BENGAL);
        /** @var Breed $chartreux */
        $chartreux = $this->getReference(BreedFixtures::CHARTREUX);

        // Заведение в БД кошек
        $this->createCat($manager, 'Luna', '-1 year', $bengal);
        $this->createCat($manager, 'Milo', '-18 month', $abyssinian);
        $this->createCat($manager, 'Loki', '-5 year', $chartreux);
        $this->createCat($manager, 'Charlie', '-180 days', $chartreux);
        $this->createCat($manager, 'Leo', '-70 month', $abyssinian);
        $this->createCat($manager, 'Willow', '-2 year', null);
        $this->createCat($manager, 'Oliver', '-218 days', $chartreux);
        $this->createCat($manager, 'Bella', '-70 month', null);
        $this->createCat($manager, 'Chloe', '-500 days', $chartreux);
        $this->createCat($manager, 'Halsey', '-1 year', $bengal);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        // Указываем от каких Фиктур зависит данный класс
        return [
            BreedFixtures::class,
        ];
    }
}
