<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_funds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transaction_date')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->integer('deposit_balance')->nullable();
            $table->decimal('amount','20,4');
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
        Schema::dropIfExists('customer_funds');
    }
}
