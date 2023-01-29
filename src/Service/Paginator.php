<?php

namespace App\Service;

class Paginator
{
    const DEFAULT_PAGE = 0;
    const DEFAULT_PAGE_SIZE = 2;
    private int $page;
    private int $pageSize;

    public function setPage(array $filters): Paginator
    {
        $page = self::DEFAULT_PAGE;
        if (array_key_exists('page', $filters) && $filters['page'] > 0) {
            $page = $filters['page'] - 1;
        }

        $this->page = $page;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPageSize(array $filters): void
    {
        $pageSize = self::DEFAULT_PAGE_SIZE;
        if (array_key_exists('pageSize', $filters)) {
            $pageSize = $filters['pageSize'];
        }

        $this->pageSize = $pageSize;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }
}
