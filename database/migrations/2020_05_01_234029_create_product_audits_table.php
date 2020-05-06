<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_infos_id')->unsigned();
            $table->string('pol')->nullable();
            $table->longText('summary')->nullable();
            $table->date('audit_date');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('product_audits');
    }
}
