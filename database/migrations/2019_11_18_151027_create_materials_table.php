<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Product_Code','50')->nullable();
            $table->string('Product_Name','100')->nullable();
            $table->text('Description')->nullable();
            $table->string('unit','20')->nullable();
            $table->string('supplier','10')->nullable();
            $table->double('srp',20,4)->nullable();
            $table->string('uid','10');
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
        Schema::dropIfExists('materials');
    }
}
