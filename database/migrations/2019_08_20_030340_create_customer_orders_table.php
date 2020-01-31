<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id','10');
            $table->string('no_orders','20')->nullable();
            $table->string('payment_terms','50')->nullable();
            $table->string('plan','100')->nullable();
            $table->double('total_amount',20,4)->nullable();
            $table->integer('balance')->nullable();
            $table->date('order_date')->nullable();
            $table->date('recieve_date')->nullable();
            $table->string('status','25');
            $table->string('release_by','10')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
}
