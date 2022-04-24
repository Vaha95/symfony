<?php

namespace App\Controller;

use App\Entity\Cat;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/cats', name: 'cats_')]
class CatController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route(path: '', name: 'get_all', methods: ['GET'])]
    public function getAllCatsAction(): Response
    {
        // Получение всех кошек заведённых в систему
        $cats = $this->doctrine->getRepository(Cat::class)->findAll();
        $cats = array_map(function ($cat) {
            /* @var Cat $cat */
            // Структурирование сущностей для ответа на запрос
            return $cat->__toArray();
        }, $cats);

        return new JsonResponse($cats, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route(path: '/{cat<\d+>}', name: 'delete', methods: ['DELETE'])]
    public function deleteCatAction(Cat $cat): Response
    {
        $em = $this->doctrine->getManager();
        $em->remove($cat);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT, ['Content-Type' => 'application/json']);
    }
}
