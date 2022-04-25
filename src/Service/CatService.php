<?php

namespace App\Service;

use App\Entity\Cat;
use Doctrine\Persistence\ManagerRegistry;

class CatService
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getAllCats(): ?array
    {
        // Получение всех кошек заведённых в систему
        $cats = $this->doctrine->getRepository(Cat::class)->findAll();
        $cats = array_map(function ($cat) {
            /* @var Cat $cat */
            // Структурирование сущностей для ответа на запрос
            return $cat->__toArray();
        }, $cats);

        return $cats;
    }

    public function removeCat(Cat $cat): void
    {
        $em = $this->doctrine->getManager();
        $em->remove($cat);
        $em->flush();
    }
}
