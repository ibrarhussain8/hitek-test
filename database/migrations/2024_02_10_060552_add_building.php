<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuilding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->integer('monthly_consumption');
            $table->text('location_details');
            $table->timestamps();
        });

        Schema::create('building_images',function(Blueprint $table){
            $table->id();
            $table->integer('building_id');
            $table->string('image_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('building_images');
    }
}
