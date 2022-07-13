<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeoples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->integer('height')->nullable();
			$table->integer('mass')->nullable();
			$table->string('hair_color')->nullable();
			$table->string('skin_color')->nullable();
			$table->string('eye_color')->nullable();
			$table->string('birth_year')->nullable();
			$table->string('gender')->nullable();
			$table->string('homeworld')->nullable();
//			$table->string('species')->nullable();
            $table->timestamp('created')->nullable();
            $table->timestamp('edited')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peoples');
    }
}
