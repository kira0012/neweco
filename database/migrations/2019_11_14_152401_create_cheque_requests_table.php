<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheque_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('request_date');
            $table->date('approved_date')->nullable();
            $table->string('payee',50);
            $table->text('remarks');
            $table->double('amount',20,4);
            $table->string('status',10);
            $table->string('request_by',10);
            $table->string('approved_by',10)->nullable();
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
        Schema::dropIfExists('cheque_requests');
    }
}
