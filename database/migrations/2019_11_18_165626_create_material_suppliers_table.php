<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Supplier','100');
            $table->string('Address','100');
            $table->string('email','50')->nullable();
            $table->string('contact','100');
            $table->string('contact_person')->nullable();
            $table->string('c_number',50)->nullable();
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
        Schema::dropIfExists('material_suppliers');
    }
}
