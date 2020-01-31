<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer','100')->nullable();
            $table->string('cat_id','10');
            $table->date('jo_date');
            $table->string('title')->nullable();
            $table->text('description');
            $table->double('amount',20,4);
            $table->double('cost',20,4)->nullable();
            $table->string('status');
            $table->string('post_by');
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
        Schema::dropIfExists('job_orders');
    }
}
