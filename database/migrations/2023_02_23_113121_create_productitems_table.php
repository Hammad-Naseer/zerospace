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
        Schema::create('productitems', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedBigInteger('p_id');
            $table->unsignedBigInteger('var_id');
            $table->string('item_serial_no');
            $table->string('item_barcode')->nullable();
            $table->string('item_barcode_img');
            $table->string('item_sku');
            $table->string('item_asin');
            $table->string('item_img');
            // $table->decimal('item_purchase_price', 10, 2)->nullable();
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
        Schema::dropIfExists('productitems');
    }
};