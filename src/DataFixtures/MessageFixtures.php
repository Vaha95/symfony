<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $pim = $this->getReference(UserFixtures::PIM);
        $han = $this->getReference(UserFixtures::HAN);

        $main = $this->getReference(ChatFixtures::MAIN);
        $secret = $this->getReference(ChatFixtures::SECRET);

        $message = new Message();

        $date = $this->getDate('- 15 days');

        $message
            ->setAuthor($pim)
            ->setChat($main)
            ->setContent('Hello')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $message = new Message();

        $message
            ->setAuthor($pim)
            ->setChat($main)
            ->setContent('It`s me')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $date = $this->getDate('- 14 days');

        $message = new Message();

        $message
            ->setAuthor($han)
            ->setChat($main)
            ->setContent('Hello!')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $message = new Message();

        $message
            ->setAuthor($han)
            ->setChat($main)
            ->setContent('How are you?')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $message = new Message();

        $date = $this->getDate('-10 days');

        $message
            ->setAuthor($pim)
            ->setChat($secret)
            ->setContent('This chat is confidencial?')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $date = $this->getDate('-9 days');

        $message = new Message();

        $message
            ->setAuthor($han)
            ->setChat($secret)
            ->setContent('Yes, of course!')
            ->setDate($date)
            ->setTime($date);

        $manager->persist($message);

        $manager->flush();
    }

    public function getDate($expression): \DateTimeInterface
    {
        $time = new \DateTime($expression);
        $timeZone = new \DateTimeZone('Europe/Moscow');
        $time->setTimezone($timeZone);

        return $time;
    }

    public function getDependencies(): array
    {
        return [
            ChatFixtures::class,
        ];
    }
}
