<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testGet(): void
    {
        $client = static::createClient();

        $client->request('GET', '/article');

        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
    }
}
