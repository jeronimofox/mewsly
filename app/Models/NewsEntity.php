<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string category
 * @property string entity
 * @property integer article_id
 */
class NewsEntity extends Model
{
    use HasFactory, ElasticsearchIndex;
    protected $table = "news_entities";
    protected static $index = 'news_entities';

    protected $fillable = [
        'article_id',
        'category',
        'entity',
        'article'
    ];

    /**
     * @param NewsArticle $article
     * @param string $category
     * @param string $entity
     */
    public function store(NewsArticle $article, string $category = "", string $entity = "")
    {
        $entity = new NewsEntity();
        $entity->category = $category;
        $entity->entity = $entity;
        $entity->article_id = $article->id;
        $entity->save();
        $entity->documents = (array)$entity;

    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(NewsArticle::class, 'article_id');
    }

    public function isLocationRelated()
    {
        return in_array($this->category, ['LOCATION', 'CITY', 'COUNTRY', 'REGION', 'STATE']);
    }
}
