<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('cost_in_credits')->nullable();
            $table->string('crew')->nullable();
            $table->string('hyperdrive_rating')->nullable();
            $table->string('starship_class')->nullable();
            $table->integer('length')->nullable();
            $table->integer('max_atmosphering_speed')->nullable();
            $table->integer('passengers')->nullable();
            $table->integer('cargo_capacity')->nullable();
            $table->integer('MGLT')->nullable();
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
        Schema::dropIfExists('starships');
    }
}
