<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_cars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->restrictOnDelete()->nullable(false);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->restrictOnDelete()->nullable(false);
            $table->unsignedInteger('year')->nullable(false);
            $table->string('number')->nullable(false);
            $table->string("image")->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_cars');
    }
};
