<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\ArticleService;
use App\Service\Paginator;
use PHPUnit\Framework\TestCase;

class ArticleServiceTest extends TestCase
{
    public function testCalculateTotalSalary()
    {
        $article = new Article();
        $articleRepository = $this->createMock(ArticleRepository::class);
        $articleRepository->expects($this->any())
            ->method('findByDate')
            ->willReturn([$article]);

        $page = new Paginator();
        $page->setPage(['page' => 1])->setPageSize(['pageSize' => 10]);

        $service = new ArticleService($articleRepository, $page);
        $result = $service->findByDate('29-01-2023');

        $this->assertEquals([$article], $result);
    }
}
