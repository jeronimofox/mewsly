<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsApiSource extends Model
{
    use HasFactory, ElasticsearchIndex;

    public static string $index = "news_api_sources";

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'article_id',
        'name'
    ];

    public function articles()
    {
        return $this->hasMany(NewsArticle::class, 'article_id');
    }
}
