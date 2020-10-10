<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string document
 */
class NewsApiResponse extends Model
{
    use HasFactory, ElasticsearchIndex;

    protected $fillable = [
        'articles'
    ];

    public static string $index = "news_api_responses";

    public array $articles = [];

    public array $source = [];

    /**
     * @var array|mixed
     */

    public function source()
    {
        return $this->belongsTo(NewsApiSource::class, 'source');
    }

    public function articles()
    {
        return $this->hasMany(NewsArticle::class, 'articles');
    }


}
