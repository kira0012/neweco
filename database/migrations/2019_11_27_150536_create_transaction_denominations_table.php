<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDenominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_denominations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_id','10')->nullable();
            $table->string('group_id','10')->nullable();
            $table->string('ca1000')->nullable();
            $table->string('ca500')->nullable();
            $table->string('ca200')->nullable();
            $table->string('ca100')->nullable();
            $table->string('ca50')->nullable();
            $table->string('ca20')->nullable();
            $table->string('ca10')->nullable();
            $table->string('ca5')->nullable();
            $table->string('ca1')->nullable();
            $table->string('ca025c')->nullable();
            $table->string('ca010c')->nullable();
            $table->string('ca05c')->nullable();
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
        Schema::dropIfExists('transaction_denominations');
    }
}
