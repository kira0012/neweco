<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJoFecDirectDeposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jo_payments', function (Blueprint $table) {
            //
            $table->string('bank_id','10')->nullable();
            $table->string('trans_no','50')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jo_payments', function (Blueprint $table) {
            //
        });
    }
}
