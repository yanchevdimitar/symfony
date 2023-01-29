<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'list_article', methods: ['GET'])]
    public function index(ArticleService $articleService, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $params = $request->query->all();
        $articles = $articleService->findByFilters($params);
        $content = $serializer->serialize($articles, $params['format'] ?? 'json', [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s',]);

        return JsonResponse::fromJsonString($content);
    }

    #[Route('/article', name: 'create_article', methods: ['POST'])]
    public function create(Request $request, ArticleService $articleService, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $article = $serializer->deserialize($request->getContent(), Article::class, 'json');
        $errors = $validator->validate($article);

        if (count($errors) > 0) {
            $errorsString = (string)$errors;

            throw new BadRequestHttpException($errorsString);
        }

        $articleService->create($article);

        return new Response('', Response::HTTP_OK);
    }
}
