<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jo_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jo_id','10');
            $table->string('checkno','100')->nullable();
            $table->string('payee','150')->nullable();
            $table->date('payment_date');
            $table->double('amount',20,4);
            $table->string('status','20');
            $table->string('recieve_by','10');
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
        Schema::dropIfExists('jo_payments');
    }
}
