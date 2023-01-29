<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testSettingArticleTitle()
    {
        $customer = new Article();
        $customer->setTitle('test');

        $this->assertEquals('test', $customer->getTitle());
    }
}
