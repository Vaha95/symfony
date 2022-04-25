<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Service\CatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/cats', name: 'cats_')]
class CatController extends AbstractController
{
    private CatService $catService;

    public function __construct(CatService $catService)
    {
        $this->catService = $catService;
    }

    #[Route(path: '', name: 'get_all', methods: ['GET'])]
    public function getAllCatsAction(CatService $catService): Response
    {
        return new JsonResponse(
            $this->catService->getAllCats(),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route(path: '/{cat<\d+>}', name: 'delete', methods: ['DELETE'])]
    public function deleteCatAction(Cat $cat): Response
    {
        $this->catService->removeCat($cat);

        return new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT,
            ['Content-Type' => 'application/json']
        );
    }
}
