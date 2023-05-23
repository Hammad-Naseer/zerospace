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
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('pur_id');
            $table->string('pur_refrence_no');
            $table->string('vend_id');
            $table->string('pur_date');
            $table->string('pur_status');
            $table->string('pur_document')->nullable();
            $table->string('pur_total_amount');
            $table->string('remarks')->nullable();
            $table->string('alibaba_charges')->nullable();
            $table->string('shipping_charges')->nullable();
            $table->string('miscellaneous_charges')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
