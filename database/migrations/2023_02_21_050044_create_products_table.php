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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('p_id');
            $table->unsignedBigInteger('acc_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('cat_id');
            $table->string('p_name',100);
            $table->longText('p_description')->nullable();
            $table->tinyInteger('p_status');
            $table->string('p_units_in_carton',20)->nullable();
            $table->string('p_net_weight',20)->nullable();
            $table->string('p_gross_weight',20)->nullable();
            $table->unsignedBigInteger('p_alert_qty');
            $table->unsignedBigInteger('p_listing_owner')->nullable();
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
        Schema::dropIfExists('products');
    }
};