<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('cost_in_credits')->nullable();
            $table->integer('max_atmosphering_speed')->nullable();
            $table->integer('passengers')->nullable();
            $table->integer('cargo_capacity')->nullable();
            $table->float('length')->nullable();
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('crew')->nullable();
            $table->string('consumables')->nullable();
            $table->string('vehicle_class')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
