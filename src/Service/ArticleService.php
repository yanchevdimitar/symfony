<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

readonly class ArticleService
{
    public function __construct(
        public ArticleRepository $articleRepository,
        private Paginator        $paginator
    )
    {
    }

    public function create(Article $article): void
    {
        $this->articleRepository->save($article, true);
    }

    public function findByFilters(array $filters = []): array
    {
        $this->paginator->setPage($filters)->setPageSize($filters);

        return $this->findByDate($filters['date'] ?? null, $this->paginator);
    }

    public function findByDate(?string $date): array
    {
        try {
            $date = $date ? new DateTime($date) : null;

            return $this->articleRepository->findByDate($date, $this->paginator->getPage(), $this->paginator->getPageSize());
        } catch (\Doctrine\DBAL\Exception $e) {
            throw new ConflictHttpException('DB failed');
        } catch (Exception $exception) {
            throw new BadRequestHttpException('Invalid date: ' . $exception->getMessage());
        }
    }
}
