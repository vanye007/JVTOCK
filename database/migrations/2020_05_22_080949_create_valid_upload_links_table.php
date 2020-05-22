<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidUploadLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valid_upload_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_infos_id')->unsigned();
            $table->string('name');
            $table->string('uploaded');
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
        Schema::dropIfExists('valid_upload_links');
    }
}
