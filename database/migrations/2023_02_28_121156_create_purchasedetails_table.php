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
        Schema::create('purchasedetails', function (Blueprint $table) {
            $table->increments('pur_detail_id');
            $table->string('pur_id');
            $table->string('item_id');
            $table->string('item_purchase_price');
            $table->string('units_in_carton');
            $table->string('pur_item_qty');
            $table->string('carton_qty');
            $table->string('sub_total_amount');
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
        Schema::dropIfExists('purchasedetails');
    }
};
