<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drno',10);
            $table->string('customer','50');
            $table->string('total_return','100');
            $table->text('remarks')->nullable();
            $table->string('action_by');
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
        Schema::dropIfExists('return_infos');
    }
}
