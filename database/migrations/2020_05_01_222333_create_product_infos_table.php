<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('facility_infos_id')->unsigned();
            $table->string('name');
            $table->string('image');
            $table->longText('description');
            $table->string('price');
            $table->string('volume');
            $table->string('inventory');
            $table->string('capacity');
            $table->timestamps();

            $table->foreign('facility_infos_id')->references('id')->on('facility_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_infos');
    }
}
