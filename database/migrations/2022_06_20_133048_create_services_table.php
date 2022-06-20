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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_service_category');
            $table->foreign('id_service_category')->references('id')->on('service_categories')->restrictOnDelete()->nullable(false);
            $table->string("name")->nullable(false);
            $table->unsignedInteger("duration")->nullable(false);
            $table->unsignedInteger("price")->nullable(false);

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
        Schema::dropIfExists('services');
    }
};
