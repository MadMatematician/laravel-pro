<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('classification');
            $table->string('skin_colors')->nullable();
            $table->string('hair_colors')->nullable();
            $table->string('eye_colors')->nullable();
            $table->string('average_lifespan')->nullable();
            $table->string('language')->nullable();
            $table->integer('average_height')->nullable();
            $table->integer('homeworld')->nullable();
            $table->timestamps('created');
            $table->timestamps('edited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
