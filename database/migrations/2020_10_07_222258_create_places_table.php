<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('resultType');
            $table->string('houseNumberType');
            $table->foreignIdFor(\App\Models\PlaceAddress::class)->name('address');
            $table->foreignIdFor(\App\Models\PlacePosition::class)->name('position');
            $table->foreignIdFor(\App\Models\PlaceAddress::class)->name('access');
            $table->foreignIdFor(\App\Models\PlaceAddress::class)->name('mapView');
            $table->foreignIdFor(\App\Models\PlaceAddress::class)->name('scoring');
            $table->timestamps();

            $table->unique(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
