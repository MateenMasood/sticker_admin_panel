<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortFacilityFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resort_facility_files', function (Blueprint $table) {
            $table->id();
            $table->string('resort_facility_file_id');
            $table->integer('resort_facility_id');
            $table->string('path');
            $table->string('file_name');
            $table->string('size');
            $table->string('mime_type');
            $table->string('extension');
            $table->string('zone')->comment="base image or optional image";
            $table->string('title')->comment="image title that will be display on image";
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
        Schema::dropIfExists('resort_facility_files');
    }
}
