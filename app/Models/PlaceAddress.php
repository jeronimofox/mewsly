<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceAddress extends Model
{
    use HasFactory, ElasticsearchIndex;

    protected $fillable = [
        'label',
        'countryCode',
        'countryName',
        'state',
        'county',
        'city',
        'district',
        'street',
        'postalCode'
    ];

    protected static string $index = "places";


}
