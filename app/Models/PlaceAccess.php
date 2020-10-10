<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceAccess extends Model
{
    use HasFactory, ElasticsearchIndex;

    protected static string $index = "places";

}
