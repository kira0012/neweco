<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ca_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('drno')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->decimal('10','4');
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
        Schema::dropIfExists('ca_transactions');
    }
}
