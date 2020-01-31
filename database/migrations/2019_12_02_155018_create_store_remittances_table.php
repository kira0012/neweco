<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreRemittancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_remittances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_id');
            $table->date('remittance_date');
            $table->string('remittance_type')->nullable();
            //cheque details
            $table->string('payee')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_date')->nullable();
            //bank details
            $table->string('bank_id')->nullable();
            $table->string('reference_no')->nullable();
            //amount of remittance
            $table->string('amount')->nullable();
            $table->string('recieved_by');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('store_remittances');
    }
}
