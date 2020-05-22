<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_msg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_infos_id')->unsigned();
            $table->bigInteger('template_id')->unsigned();
            $table->string('header');
            $table->string('message');
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('template')->onDelete('cascade');
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
        Schema::dropIfExists('template_msg');
    }
}
