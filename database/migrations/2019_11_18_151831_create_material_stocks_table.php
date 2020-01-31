<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('material_id','10');
            $table->string('recieve_id','10');
            $table->string('no_recieved','10')->nullable();
            $table->string('warehouse_id','10')->nullable();
            $table->double('price',20,4);
            $table->double('srp',20,4);
            $table->string('stock','50')->nullable();
            $table->string('available','50')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('material_stocks');
    }
}
