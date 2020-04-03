<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product');
            $table->string('country');
            $table->integer('price');
            $table->string('product_reference');
            $table->string('production_quantity');
            $table->string('certificates');
            $table->string('supplier');
            $table->string('company');
            $table->string('origin');
            //pot of origin // export port
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
        Schema::dropIfExists('supplier');
    }
}
