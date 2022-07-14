<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->integer('episode_id')->nullable();
            $table->string('title');
            $table->string('opening_crawl')->nullable();
            $table->string('director')->nullable();
            $table->string('producer')->nullable();
            $table->timestamp('release_date')->nullable();
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
        Schema::dropIfExists('films');
    }
}
