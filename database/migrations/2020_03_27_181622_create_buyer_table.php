<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('country');
            $table->foreign('product_id')->references('id')->on('product');
            $table->string('demand');
            $table->string('certificates');
            $table->string('plug');
            $table->string('PO')->null();
            $table->string('P0F')->null();
            //proof of fund
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
        Schema::dropIfExists('buyer');
    }
}
