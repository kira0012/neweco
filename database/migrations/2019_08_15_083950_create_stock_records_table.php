<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_id','10');
            $table->string('warehouse_id','10');
            $table->string('product_id','10');
            $table->integer('no_recieve');
            $table->integer('available');
            $table->integer('stock');
            $table->double('price',20,4);
            $table->string('transfer_id')->nullable();
            $table->string('inserted_by','10');
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
        Schema::dropIfExists('stock_records');
    }
}
