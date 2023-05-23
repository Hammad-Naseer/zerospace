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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->increments('p_size_id');
            $table->unsignedBigInteger('p_id');
            $table->string('p_box_size_length')->nullable();
            $table->string('p_box_size_width')->nullable();
            $table->string('p_box_size_height')->nullable();
            $table->string('p_box_size_unit')->nullable();
            $table->string('p_carton_size_length')->nullable();
            $table->string('p_carton_size_width')->nullable();
            $table->string('p_carton_size_height')->nullable();
            $table->string('p_carton_size_unit')->nullable();
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
        Schema::dropIfExists('product_sizes');
    }
};