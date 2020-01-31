<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action','30');
            $table->string('table','30');
            $table->string('data_id','20');
            $table->string('column','30');
            $table->string('columndata','150')->nullable();
            $table->string('userid','10');
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
        Schema::dropIfExists('data_histories');
    }
}
