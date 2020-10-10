<?php

namespace Tests\Models;

use App\Models\NewsApiResponse;
use App\NewsApi\NewsApi;
use Tests\TestCase;

class NewsArticleTest extends TestCase
{
    public function testCreate()
    {

        $response = new NewsApi("top-headlines", "us", 'en');
        $response->syncArticles();
        $this->assertIsArray($response->articles);
//        $this->assertIsArray($response);
//        $articles = NewsApiResponse::setArticles($response->articles);

//        dump($articles);
//        $this->assertIsObject($articles);
    }
}
