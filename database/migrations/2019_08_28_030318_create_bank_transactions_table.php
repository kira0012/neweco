<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bank_id','10');
            $table->date('transaction_date');
            $table->string('trans_type','10');
            $table->integer('amount');
            $table->integer('balance');
            $table->string('term','10')->nullable();
            $table->string('cheque_no','100')->nullable();
            $table->string('payee','100')->nullable();
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
        Schema::dropIfExists('bank_transactions');
    }
}
