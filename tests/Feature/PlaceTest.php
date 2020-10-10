<?php

namespace Tests\Feature;

use App\Models\Place;

use Tests\TestCase;

class PlaceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPlace()
    {
        $items =
            '{ "items" :  [{
                "title": "5 Rue Daunou, 75002 Paris, France",
                "id": "here:af:streetsection:bI4Le6cyA.1mlQyLunYpjC:CggIBCCi-9SPARABGgE1KGQ",
                "resultType": "houseNumber",
                "houseNumberType": "PA",
                "address": {
                "label": "5 Rue Daunou, 75002 Paris, France",
                    "countryCode": "FRA",
                    "countryName": "France",
                    "state": "Île-de-France",
                    "county": "Paris",
                    "city": "Paris",
                    "district": "2e Arrondissement",
                    "street": "Rue Daunou",
                    "postalCode": "75002",
                    "houseNumber": "5"
                },
                "position": {
                "lat": 48.86926,
                    "lng": 2.3321
                },
                "access": [
                    {
                        "lat": 48.86931,
                        "lng": 2.33215
                    }
                ],
                "mapView": {
                "west": 2.33073,
                    "south": 48.86836,
                    "east": 2.33347,
                    "north": 48.87016
                },
                "scoring": {
                "queryScore": 0.97,
                    "fieldScore": {
                    "country": 1,
                        "city": 1,
                        "streets": [
                        1
                    ],
                        "houseNumber": 1,
                        "postalCode": 0.82
                    }
                }
            }
        ]}}';

        $place = new Place();
        $place->getClient();
        $place->document = $items;

        dump($place->getClient()->search(['body'=>['q' => 'France']]));

        $this->assertIsArray(json_decode($place->document));

    }

}
