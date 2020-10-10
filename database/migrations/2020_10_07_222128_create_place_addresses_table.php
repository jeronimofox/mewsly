<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('countryCode');
            $table->string('countryName');
            $table->string('state');
            $table->string('county');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('postalCode');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_addresses');
    }
}
