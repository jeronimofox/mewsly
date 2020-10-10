<?php

namespace App\NewsApi;

use App\Models\NewsApiResponse;
use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class NewsApi
{

    public static array $endpoint = [
        'top-headlines' => [
            'country',
            'language'
        ],
        'everything' => [
            'category',
            'language',
            'subject'
        ],
        'sources' => [
            'language',
            'sourceName'
        ]
    ];

    /**
     * @var array[]
     */
    private array $parameters = [];
    private string $url;
    private string $query;
    private string $type;
    /**
     * @var array|mixed
     */
    private $news;
    public array $articles;

    /**
     * NewsApi constructor.
     * @param string $endpoint
     * @param string $country
     * @param string $language
     * @param string $category
     * @param string $source
     * @param string $subject
     */
    public function __construct(string $endpoint = 'top-headlines',
                                string $country = "us",
                                string $language = "en",
                                string $category = "business",
                                string $source = "CNN",
                                string $subject = "")
    {
        $this->type = $endpoint;
        foreach (static::$endpoint[$endpoint] as $item) {
            $this->parameters[$item] = ${$item};
        }
        $this->query = $this->getQuery();
        $this->url = $this->getUrl();
        $this->news = $this->getNews();

    }

    private function getQuery()
    {
        $query = $this->type . "?";
        foreach ($this->parameters as $name => $value) {
            $query .= $name . "=" . $value . "&";
        }
        return $query;
    }

    private function getUrl()
    {
        return env('NEWSAPI_HOST') . "/" . $this->query . "pageSize=25&apiKey=" . env('NEWSAPI_KEY');
    }

    protected function getNews()
    {
        return Http::acceptJson()->get($this->url)->throw(function (\Exception $e) {
            return $e;
        })->json();
    }

    public function syncArticles()
    {
        foreach ($this->news['articles'] as $item) {
            $article = (new NewsArticle)->store($item);
            $this->articles[] = $article;
        }
    }

}
