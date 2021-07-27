<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNearByPlaceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('near_by_place_files', function (Blueprint $table) {
            $table->id();
            $table->string('near_by_place_file_id');
            $table->integer('near_by_place_id');
            $table->string('path');
            $table->string('file_name');
            $table->string('size');
            $table->string('mime_type');
            $table->string('extension');
            $table->string('zone')->comment="base image or optional image";
            $table->enum('status',['0' , '1']);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('near_by_place_files');
    }
}
