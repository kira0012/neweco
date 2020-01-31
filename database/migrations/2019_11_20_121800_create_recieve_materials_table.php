<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecieveMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recieve_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('recieved_date');
            $table->string('supplier_id',10);
            $table->double('total_cost',20,4);
            $table->string('item_recieved',60)->nullable();
            $table->text('remarks')->nullable();
            $table->string('warehouse_id','20')->nullable();
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
        Schema::dropIfExists('recieve_materials');
    }
}
