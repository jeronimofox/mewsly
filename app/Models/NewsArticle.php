<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Throwable;
use Web64\LaravelNlp\Facades\NLP;

/**
 * @property mixed content
 * @property mixed id
 * @property mixed url
 */
class NewsArticle extends Model
{
    use HasFactory, ElasticsearchIndex;

    public array $entities = [];

    protected $fillable = [
        'author',
        'title',
        'description',
        'url',
        'urlToImage',
        'publishedAt',
        'content'
    ];

    public static string $index = "news_articles";


    /**
     * Get full article's content by crawling its from url
     * @return string
     */
    public function getFullContent(string $url): string
    {
        $article = NLP::article($url);
        return !empty($article['text']) ? $article['text'] : $this->content;
    }


    /**
     * Get all related entities
     * @return HasMany
     */
    public function entities()
    {
        return $this->hasMany(NewsEntity::class, 'article_id');
    }



    /**
     *  Parse entities from article's content
     */
    public function parseEntities(string $content)
    {
        $entities = NLP::corenlp_entities($content, 'en');
        foreach ($entities as $key => $value) {
            foreach ($value as $item) {
                $entity = $this->entities()->create(['category'=>$key, 'entity'=> $item]);
                $entity->documents = (array)$entity;
            }
        };
    }

    /** Article's source
     * @return HasOne
     */
    public function source(): HasOne
    {
        return $this->hasOne(NewsApiSource::class, 'article_id');
    }


    /**
     * @param array $attributes
     * @throws Throwable
     */
    public function store(array $attributes = [])
    {
        $article = new NewsArticle();
        foreach (Arr::only($attributes, $this->fillable) as $key => $value) {
            $article->{$key} = $value;
        }

        //parse article
        $article->content = $article->getFullContent($attributes['url']);
        //save article
        $article->save();
        //saving source
        $article->source()->create($attributes['source']);
        //save entities
        $article->parseEntities($article->content);
        //sync with elasticsearch index
        $article->documents = (array)$article;
    }

}
