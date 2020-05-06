<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_certs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_infos_id')->unsigned();
            $table->string('certificates');
            $table->string('path');
            $table->timestamps();

            $table->foreign('product_infos_id')->references('id')->on('product_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_certs');
    }
}
