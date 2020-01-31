<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierReturnInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_return_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_id','10');
            $table->string('total_product','10');
            $table->date('return_date')->nullable();
            $table->date('recieve_date')->nullable();
            $table->string('status','15')->nullable();
            $table->string('remarks')->nullable();
            $table->string('uid');
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
        Schema::dropIfExists('supplier_return_infos');
    }
}
