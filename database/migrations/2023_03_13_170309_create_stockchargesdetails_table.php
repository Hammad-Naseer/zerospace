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
        Schema::create('stockchargesdetails', function (Blueprint $table) {
            $table->increments('s_c_d_id');
            $table->string('stock_id');
            $table->string('item_id');
            $table->float('cbm_charges');
            $table->float('cbm');
            $table->float('shiping_uae');
            $table->float('amazon_fee');
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
        Schema::dropIfExists('stockchargesdetails');
    }
};
