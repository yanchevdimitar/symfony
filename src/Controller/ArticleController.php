<?php

namespace App\Controller;

use App\Service\Article as ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'list_article', methods: ['GET'])]
    public function index(ArticleService $articleService): JsonResponse
    {
        return new JsonResponse($articleService->getAllActive());
    }

    #[Route('/article', name: 'create_article', methods: ['POST'])]
    public function create(Request $request, ArticleService $articleService): JsonResponse
    {
        $articleService->create(json_decode($request->getContent(), true));

        return new JsonResponse('', Response::HTTP_OK);
    }
}
