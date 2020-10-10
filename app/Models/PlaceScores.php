<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed queryScore
 * @property mixed fieldScore
 */
class PlaceScores extends Model
{
    use HasFactory, ElasticsearchIndex;

    protected static string $index = "place_scores";


    public function queryScore()
    {
        return $this->queryScore;
    }

    public function fieldScore()
    {
        return $this->fieldScore;
    }
}
