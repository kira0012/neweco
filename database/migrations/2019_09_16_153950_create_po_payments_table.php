<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_id','10');
            $table->string('checkno','100')->nullable();
            $table->string('payee','150')->nullable();
            $table->date('payment_date');
            $table->double('amount',20,4);
            $table->string('status','10')->nullable();
            $table->string('process_by','10');
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
        Schema::dropIfExists('po_payments');
    }
}
