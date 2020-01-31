<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('order_date');
            $table->date('recieve_date')->nullable();
            $table->string('supplier_id','10');
            $table->double('total_cost',20,4);
            $table->string('no_order','20');
            $table->string('order_status','20');
            $table->string('order_by','20');
            $table->string('approved_by','20')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('po_details');
    }
}
