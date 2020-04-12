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
            $table->unsignedInteger('country_id');
            $table->string('email');
            $table->string('phone');
            $table->string('specifications');
            $table->string('shipping_routes');
            $table->string('shipping_terms');
            $table->string('payment_terms');
            $table->string('prices_per_capacity');
            $table->string('capacity_upgrades');
            $table->integer('price');
            $table->string('certificates');
            $table->string('product_image');
            $table->string('supply_capacity');
            $table->string('current_inventory');
            $table->string('port_of_origin');
            $table->string('units_per_box');

            $table->string('proof_of_life')->null();

            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
