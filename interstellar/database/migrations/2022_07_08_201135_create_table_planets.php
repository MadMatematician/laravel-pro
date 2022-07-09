<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlanets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->string('rotation_period');
            $table->string('orbital_period');
            $table->string('diameter');
            $table->string('climate');
            $table->string('gravity');
            $table->string('terrain');
            $table->string('surface_water');
            $table->string('population');
//            $table->json('residents');
//            $table->json('films');
            $table->timestamp('created');
            $table->timestamp('edited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planets');
    }
}
