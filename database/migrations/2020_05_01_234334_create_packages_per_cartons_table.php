<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesPerCartonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_per_cartons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_infos_id')->unsigned();
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('weight');
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
        Schema::dropIfExists('packages_per_cartons');
    }
}
