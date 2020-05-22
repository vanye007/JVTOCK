<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_infos_id')->unsigned();
            $table->string('name');
            $table->string('path');
            $table->timestamps();

            $table->foreign('supplier_infos_id')->references('id')->on('supplier_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_docs');
    }
}
