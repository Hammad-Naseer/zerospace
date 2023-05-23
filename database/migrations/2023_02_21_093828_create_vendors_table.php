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
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('vend_id');
            $table->string('vend_name',100);
            $table->string('vend_city');
            $table->string('vend_mobile')->nullable();
            $table->string('vend_profile')->nullable();
            $table->string('p_id')->nullable();
            $table->tinyInteger('vend_status');
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
        Schema::dropIfExists('vendors');
    }
};
