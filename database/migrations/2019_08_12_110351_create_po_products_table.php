<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_number','20');
            $table->string('products_id','20');
            $table->string('product_qty','20');
            $table->double('cost',20,4);
            $table->float('unit_price',20,4);
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
        Schema::dropIfExists('po_products');
    }
}
