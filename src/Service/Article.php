<?php

namespace App\Service;

use App\Repository\ArticleRepository;

class Article
{
    public function __construct(
        public readonly ArticleRepository $articleRepository
    ){

    }

    public function getAllActive(): array
    {
        return $this->articleRepository->findByStatus(true);
    }

    public function create(array $data)
    {
        $article = new \App\Entity\Article();
        $article->setContent($data['content']);
        $article->setStatus($data['status']);
        $article->setTitle($data['title']);

        $this->articleRepository->save($article, true);
    }
}
