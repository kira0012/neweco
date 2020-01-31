<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transfer_date');
            $table->date('recieve_date')->nullable();
            $table->string('from_wid','20');
            $table->string('stock_id','10');
            $table->string('ini_qty','50');
            $table->string('no_transfer','50');
            $table->string('to_wid','20');
            $table->string('status','10');
            $table->string('transfered_by','10');
            $table->string('recieved_by','10')->nullable();
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
        Schema::dropIfExists('transfer_tickets');
    }
}
