<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('supplier');
            $table->string('address');
            $table->string('email','100');
            $table->string('tin','50')->nullable();
            $table->string('phone','50')->nullable();
            $table->string('cellno','100')->nullable();
            $table->string('contact_person','50')->nullable();
            $table->string('cp_number','50')->nullable();
            $table->string('faxno','100')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
