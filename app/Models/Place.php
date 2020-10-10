<?php

namespace App\Models;

use App\Traits\ElasticsearchIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string document
 */
class Place extends Model
{
    use HasFactory, ElasticsearchIndex;

    protected $fillable = [
        'external_id',
        'resultType',
        'houseNumberType',
        'address',
        'position',
        'access',
        'mapView',
        'scoring'
    ];
    /**
     * @var mixed|string
     */
    public $external_id;

    /**
     * save external ID after $id
     * @param string $id
     */
    public function setIdAttribute(string $id)
    {
        $this->external_id = $id;
    }

    protected static string $index = "places";

    public function address()
    {
        return $this->hasOne(\App\Models\PlaceAddress::class);
    }

    public function access()
    {
        return $this->hasOne(\App\Models\PlacePosition::class);
    }

    public function field_score()
    {
        return $this->hasOne(\App\Models\PlaceAddress::class);
    }

    public function map_view()
    {
        return $this->hasOne(\App\Models\PlaceAddress::class);
    }

    public function positions()
    {
        return $this->hasOne(\App\Models\PlaceAddress::class);
    }

    public function scoring()
    {
        return $this->hasOne(PlaceScoring::class);
    }

    //don't want it right now 

}
