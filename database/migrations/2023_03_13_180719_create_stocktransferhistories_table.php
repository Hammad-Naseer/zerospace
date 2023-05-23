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
        Schema::create('stocktransferhistories', function (Blueprint $table) {
            $table->increments('s_t_h_id');
            $table->string('stock_id');
            $table->string('item_id');
            $table->string('wh_id_from')->nullable();
            $table->string('wh_id_to');
            $table->string('stock_transfer_qty');
            $table->string('type');
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
        Schema::dropIfExists('stocktransferhistories');
    }
};
