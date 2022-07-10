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
            $table->integer('height');
			$table->integer('mass');
			$table->string('hair_color');
			$table->string('skin_color');
			$table->string('eye_color');
			$table->string('birth_year');
			$table->string('gender');
			$table->string('homeworld');
			$table->string('species');
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
        Schema::dropIfExists('peoples');
    }
}
