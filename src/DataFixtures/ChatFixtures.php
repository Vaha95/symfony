<?php

namespace App\DataFixtures;

use App\Entity\Chat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChatFixtures extends Fixture implements DependentFixtureInterface
{
    const MAIN = 'main';
    const SECRET = 'secret';

    public function load(ObjectManager $manager): void
    {
        $pim = $this->getReference(UserFixtures::PIM);
        $han = $this->getReference(UserFixtures::HAN);

        $chat = new Chat();

        $chat
            ->setName('Liberta')
            ->setIsPublic(true)
            ->setIsPersonal(false)
            ->addUser($pim)
            ->addUser($han);

        $manager->persist($chat);
        $this->addReference(self::MAIN, $chat);

        $chat = new Chat();
        $chat
            ->setName('Test')
            ->setIsPublic(false)
            ->setIsPersonal(true)
            ->addUser($pim)
            ->addUser($han);

        $manager->persist($chat);
        $this->addReference(self::SECRET, $chat);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}