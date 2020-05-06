<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('business_infos_id')->unsigned();
            $table->unsignedInteger('country_id');
            $table->string('region');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->string('port_of_origin');
            $table->longText('shipping_terms');
            $table->longText('payment_terms');
            $table->timestamps();

            $table->foreign('business_infos_id')->references('id')->on('business_infos')->onDelete('cascade');
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
        Schema::dropIfExists('facility_infos');
    }
}
