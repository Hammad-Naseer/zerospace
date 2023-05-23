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
        Schema::create('stockdetails', function (Blueprint $table) {
            $table->increments('stock_detail_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('wh_id');
            $table->string('item_id');
            $table->string('stock_qty');
            $table->float('total_cost');
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
        Schema::dropIfExists('stockdetails');
    }
};