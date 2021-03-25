<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisinetypeRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuisinetype_restaurant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('cuisinetype_id');
            // $table->foreignId('restaurant_id')->constrained('restaurants');
            // $table->foreignId('cuisinetype_id')->constrained('cuisinetypes');
        });
        Schema::table('cuisinetype_restaurant', function (Blueprint $table){
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('cuisinetype_id')->references('id')->on('cuisinetypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cuisinetype_restaurant');
    }
}
