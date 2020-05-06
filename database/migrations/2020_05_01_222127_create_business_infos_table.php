<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_infos_id')->unsigned();
            $table->unsignedInteger('country_id');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->timestamps();

            $table->foreign('supplier_infos_id')->references('id')->on('supplier_infos')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_infos');
    }
}
